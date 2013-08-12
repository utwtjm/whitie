<?php 

// ==================================================================
//
// 覆寫 CI_Image_lib
//
// ------------------------------------------------------------------

class MY_Image_lib extends CI_Image_lib {

    var $src_width = '';
    var $src_height = '';

	public function __construct($props = array()) {
        parent::__construct($props);
    }

    /**
     *  會判斷 src_width src_height 有沒有設定如果有的話，imagecopyresampled 就傳 src_width src_height
     * 
     */
    function image_process_gd($action = 'resize')
    {
        $v2_override = FALSE;

        // If the target width/height match the source, AND if the new file name is not equal to the old file name
        // we'll simply make a copy of the original with the new name... assuming dynamic rendering is off.
        if ($this->dynamic_output === FALSE)
        {
            if ($this->orig_width == $this->width AND $this->orig_height == $this->height)
            {
                if ($this->source_image != $this->new_image)
                {
                    if (@copy($this->full_src_path, $this->full_dst_path))
                    {
                        @chmod($this->full_dst_path, FILE_WRITE_MODE);
                    }
                }

                return TRUE;
            }
        }

        // Let's set up our values based on the action
        if ($action == 'crop')
        {
            //  Reassign the source width/height if cropping
            $this->orig_width  = $this->width;
            $this->orig_height = $this->height;

            // GD 2.0 has a cropping bug so we'll test for it
            if ($this->gd_version() !== FALSE)
            {
                $gd_version = str_replace('0', '', $this->gd_version());
                $v2_override = ($gd_version == 2) ? TRUE : FALSE;
            }
        }
        else
        {
            // If resizing the x/y axis must be zero
            $this->x_axis = 0;
            $this->y_axis = 0;
        }

        //  Create the image handle
        if ( ! ($src_img = $this->image_create_gd()))
        {
            return FALSE;
        }

        //  Create The Image
        //
        //  old conditional which users report cause problems with shared GD libs who report themselves as "2.0 or greater"
        //  it appears that this is no longer the issue that it was in 2004, so we've removed it, retaining it in the comment
        //  below should that ever prove inaccurate.
        //
        //  if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor') AND $v2_override == FALSE)
        if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor'))
        {
            $create = 'imagecreatetruecolor';
            $copy   = 'imagecopyresampled';
        }
        else
        {
            $create = 'imagecreate';
            $copy   = 'imagecopyresized';
        }

        $dst_img = $create($this->width, $this->height);

        // 小白改的，讓 gif 保持透明 keeping transparency 
        $transparent_index = imagecolortransparent($src_img);
        if ($transparent_index >= 0) {
            imagepalettecopy($src_img, $dst_img);
            imagefill($dst_img, 0, 0, $transparent_index);
            imagecolortransparent($dst_img, $transparent_index);
            imagetruecolortopalette($dst_img, true, 256);
        }  

        if ($this->image_type == 3) // png we can actually preserve transparency
        {
            imagealphablending($dst_img, FALSE);
            imagesavealpha($dst_img, TRUE);
        }

        // 小白改寫
        if(empty($this->src_width) && empty($this->src_height)) {
            $sample_src_width = $this->orig_width;
            $sample_src_height = $this->orig_height;
        } else {
            $sample_src_width = $this->src_width;
            $sample_src_height = $this->src_height;
        }
        $copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $sample_src_width, $sample_src_height);

        //  Show the image
        if ($this->dynamic_output == TRUE)
        {
            $this->image_display_gd($dst_img);
        }
        else
        {
            // Or save it
            if ( ! $this->image_save_gd($dst_img))
            {
                return FALSE;
            }
        }

        //  Kill the file handles
        imagedestroy($dst_img);
        imagedestroy($src_img);

        // Set the file to 777
        @chmod($this->full_dst_path, FILE_WRITE_MODE);

        return TRUE;
    }

    /**
     *
     * 清掉 error message
     *
     * @param type param
     *
     */
    public function clear_error() {
        $this->error_msg = array();
    }

}