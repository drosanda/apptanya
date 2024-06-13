<?php
/**
 * Seme Image Resizer Class
 * 
 * @version 2024.06.13-1144
 */
class Seme_Imageresize {
    private $gd_image_object; // Holds the image resource
    private $current_height;         // Holds the image height
    private $current_width;          // Holds the image width
    private $height;         // Holds the image height
    private $width;          // Holds the image width
    private $longest_side;   // Holds the longest side of the image
    public $quality = -1;    // Quality for saving the image

    /**
     * Constructor to initialize the properties
     */
    public function __construct()
    {
        $this->gd_image_object = null;
        $this->current_height = null;
        $this->current_width = null;
        $this->height = null;
        $this->width = null;
        $this->longest_side = null;
    }

    /**
     * Checks if the image resource is valid before saving
     *
     * @return bool
     */
    private function beforeSaveToFile()
    {
        return is_object($this->gd_image_object);
    }

    /**
     * Return loaded gd_image_object resouce
     *
     * @return GdImage object
     */
    public function loaded()
    {
        return $this->gd_image_object;
    }

    /**
     * Create empty or Blank image
     *
     * @return $this
     */
    public function blank_image($width, $height)
    {
        if (!is_int($width) || $width <= 0 || !is_int($height) || $height <= 0) {
            throw new Exception("Width / height must be a positive integer.");
        }
        $this->gd_image_object = imagecreatetruecolor($width, $height);
        $this->current_width = $width;
        $this->current_height = $height;

        return $this;
    }

    /**
     * Loads an image from a given source file
     *
     * @param string $source
     * @return $this
     */
    public function load($source)
    {
        $info = getimagesize($source);
        if ($info === false) {
            throw new Exception("Invalid image source: $source");
        }
        $this->current_width = $info[0];
        $this->current_height = $info[1];
        switch ($info['mime']) {
            case 'image/webp':
                $this->gd_image_object = imagecreatefromwebp($source);
                break;
            case 'image/jpeg':
                $this->gd_image_object = imagecreatefromjpeg($source);
                break;
            case 'image/gif':
                $this->gd_image_object = imagecreatefromgif($source);
                break;
            case 'image/png':
                $this->gd_image_object = imagecreatefrompng($source);
                break;
            default:
                throw new Exception("Unsupported image format: " . $info['mime']);
        }

        return $this;
    }

    /**
     * Calculates and sets the width, height, and longest side
     *
     * @param int $width
     * @param int $height
     * @return $this
     */
    private function calculateWH($width, $height)
    {
        $this->width = intval($width);
        $this->height = intval($height);
        $this->longest_side = max($width, $height);

        return $this;
    }

    /**
     * Resizes the image to the given width and height
     *
     * @param int $width
     * @param int $height
     * @param string $mode
     * @param bool $crop_center
     * @return $this
     * @throws Exception
     */
    public function resize($width, $height = '', $mode = 'fill', $crop_center = true)
    {
        if (is_null($this->gd_image_object)) {
            throw new Exception("No image loaded. Please load an image before resizing.");
        }

        if (!is_int($width) || $width <= 0) {
            throw new Exception("Width must be a positive integer.");
        }

        if ($height === '') {
            $height = $width;
        } elseif (!is_int($height) || $height <= 0) {
            throw new Exception("Height must be a positive integer or an empty string.");
        }

        $this->calculateWH($width, $height);

        if ($crop_center) {
            $this->crop_center($width, $height);
        } else {
            $this->gd_image_object = imagescale($this->gd_image_object, $this->width, $this->height);
        }

        return $this;
    }

    /**
     * Recolor the image by overriding the RGB values
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return $this
     */
    public function allocateColor($red = 0, $green = 0, $blue = 0)
    {
        if (is_null($this->gd_image_object)) {
            throw new Exception("No image loaded. Please load an image before resizing.");
        }
        if (!is_int($red) || $red < 0 || !is_int($green) || $green < 0 || !is_int($blue) || $blue < 0) {
            throw new Exception("RGB value(s) must be a positive integer.");
        }
        if ($red > 255 || $green > 255 || $blue > 255) {
            throw new Exception("Maximum RGB value(s) is 255.");
        }

        $this->gd_image_object = imagecolorallocate($this->gd_image_object, $red, $green, $blue);

        return $this;
    }

    /**
     * Fill the image
     *
     * @param int $color
     * @param int $x
     * @param int $y
     * @return $this
     */
    public function fill($color, $x = 0, $y = 0)
    {
        if (is_null($this->gd_image_object)) {
            throw new Exception("No image loaded. Please load an image before resizing.");
        }

        $this->gd_image_object = imagefill($this->gd_image_object, $x, $y, $color);

        return $this;
    }

    /**
     * Merge 2 gd_images object
     *
     * @param resource|Seme_Imageresize  $incoming_resource
     * 
     * @return $this
     */
    public function merge($incoming_resource)
    {
        if (is_null($this->gd_image_object)) {
            throw new Exception("No image loaded. Please load an image before resizing.");
        }

        if ($incoming_resource instanceof Seme_Imageresize) {
            $incoming_resource = $incoming_resource->loaded();
        } else if ($incoming_resource instanceof GdImage) {
            $incoming_resource = null;
        }

        if (is_null($incoming_resource) || $incoming_resource == false) {
            throw new Exception("Incoming resouce is not valid gd_image object or current Seme_Imageresize object.");
        }
        $info = getimagesize($incoming_resource);

        $this->gd_image_object = imagecopymerge($this->gd_image_object, $incoming_resource, 10, 10, 0, 0, $info[0], $info[1], 100);

        return $this;
    }

    /**
     * Crop the image to the given width and height
     *
     * @param string $horizontal        'center' or ''
     * @param string $vertical          'center' or ''
     * @param int $width
     * @param int $height
     * 
     * @return $this
     * @throws Exception
     */
    public function crop($horizontal, $vertical, $width, $height)
    {
        if (is_null($this->gd_image_object)) {
            throw new Exception("No image loaded. Please load an image before cropping.");
        }

        if (!is_int($width) || $width <= 0 || !is_int($height) || $height <= 0) {
            throw new Exception("Width / height must be a positive integer.");
        }

        $x = 0;
        if ($horizontal == 'center') {
            $x = ($this->width - $width) / 2;
        }

        $y = 0;
        if ($vertical == 'center') {
            $y = ($this->height - $height) / 2;
        }

        $this->gd_image_object = imagecrop($this->gd_image_object, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);

        return $this;
    }

    /**
     * Crop the image to the center
     *
     * @param int $width
     * @param int $height
     * @return $this
     * @throws Exception
     */
    public function crop_center($width, $height)
    {
        return $this->crop('center', 'center', $width, $height);
    }

    /**
     * Saves the image resource to a file
     *
     * @param string $destination
     * @return bool|string
     */
    public function saveToFile($destination)
    {
        if ($this->beforeSaveToFile() && imagejpeg($this->gd_image_object, $destination, $this->quality)) {
            return $destination;
        } else {
            return false;
        }
    }

    /**
     * Destroy the loaded gd_image_object
     *
     * @return $this
     */
    public function destroy()
    {
        $this->gd_image_object = imagedestroy($this->gd_image_object);
        return $this;
    }
}
