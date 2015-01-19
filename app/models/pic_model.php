<?php
class Pic_model extends CI_Model {

    private $picid = 0;
    private $uid = 0;
    private $title = '';
    private $filename = '';
    private $size = '';
    private $type = '';
    private $file = '';
    private $md5 = '';
    private $classid = '';//ex: 1,2,3
    private $classid_array = array();
    private $modelname = '';
    private $thumb = '';//ex: w50h50,w300h300
    private $path = array();
    //ex: array('w0h0' => 'app/pic/00/52/85/01-abcdefg-w100h100.jpg', 'w100h100' => 'app/pic/00/52/85/01-abcdefg-w100h100.jpg')
    private $updatetime = 0;
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('file' => array(), 'picid' => 0, 'uid' => 0, 'title' => '', 'filename' => '', 'size' => 0, 'type' => '', 'thumb' => 'w50h50,w300h300', 'classid' => '', 'classid_array' => array() ) )
	{
        $data = $this->data;
        
        $file = empty($arg['file']) ? array() : $arg['file'];
		$picid = empty($arg['picid']) ? 0 : $arg['picid'];
		$uid = empty($arg['uid']) ? 0 : $arg['uid'];
        $thumb = empty($arg['thumb']) ? 'w50h50,w300h300' : $arg['thumb'];
        $title = empty($arg['title']) ? '' : $arg['title'];
        $filename = empty($arg['filename']) ? '' : $arg['filename'];
        $size = empty($arg['size']) ? 0 : $arg['size'];
        $type = empty($arg['type']) ? '' : $arg['type'];
        $md5 = empty($arg['md5']) ? '' : $arg['md5'];
        $classid = empty($arg['classid']) ? '' : $arg['classid'] ;
        $classid_array = empty($arg['classid_array']) ? array() : $arg['classid_array'] ;
        $status = empty($arg['status']) ? 1 : $arg['status'];
        
        //classid運算
        if(isset($classid) == TRUE && $classid != '' && count($classid_array) == 0)
        {
            $classid_array = explode(',', $classid);
        }
        
        $classid_array2 = $classid_array;
        $classid_set_array = array();
        foreach($classid_array2 as $key => $value)
        {
            if($value == 0 || in_array($value, $classid_set_array))
            {
                unset($classid_array[$key]);
            }
            $classid_set_array[] = $value;
        }
        $classid = implode(',', $classid_array);
        $classid_array = explode(',', $classid);
        
        //uid
        if( empty($uid) )
        {
            $uid = $data['user']['uid'];
        }
        
        //title size type filename
        if(empty($title) && !empty($file) )
        {
            $title = $file['name'];
        }
        if(empty($filename) && !empty($file) )
        {
            $filename = $file['name'];
        }
        if(empty($size) && !empty($file) )
        {
            $size = $file['size'];
        }
        if(empty($type) && !empty($file) )
        {
            $type = $file['type'];
        }
        
        //md5
        if( empty($md5) )
        {
            $md5 = substr(md5('FANSWOO'.rand(10000000, 99999999)),8,16);
        }
        
        //path
        if( !empty($thumb) && !empty($md5) && !empty($picid) )
        {
            $picid2 = abs(intval($picid));
            $picid2 = sprintf("%08d", $picid2);

            $dir1 = substr($picid2, 0, 2);
            $dir2 = substr($picid2, 2, 2);
            $dir3 = substr($picid2, 4, 2);
            $dir4 = substr($picid2, 6, 2);
            $path['w0h0'] = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'.jpg';
            
            $thumb_array = explode(',', $thumb);
            foreach($thumb_array as $key => $value)
            {
                $path[$value] = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'-'.$value.'.jpg';
            }
        }
        else
        {
            $path = array();
        }
        
        //set
        $this->picid = $picid;
        $this->uid = $uid;
        $this->filename = $filename;
        $this->thumb = $thumb;
        $this->title = $title;
        $this->size = $size;
        $this->type = $type;
        $this->md5 = $md5;
        $this->file = $file;
        $this->classid = $classid;
        $this->classid_array = $classid_array;
        $this->path = $path;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = isset($arg['db_where']) ? $arg['db_where'] : array();
        
		$this->db->from('pic');
		$this->db->where($db_where);
		$query = $this->db->get();
		$pic = $query->row_array();
        
        if( empty($pic['picid']))
        {
            return FALSE;
        }
        
        $this->construct(array(
            'picid' => $pic['picid'],
            'uid' => $pic['uid'],
            'filename' => $pic['filename'],
            'thumb' => $pic['thumb'],
            'size' => $pic['size'],
            'type' => $pic['type'],
            'title' => $pic['title'],
            'md5' => $pic['md5'],
            'classid' => $pic['classid'],
            'status' => $pic['status']
        ));
    }
    
    public function upload()
    {
        $picid = $this->picid;
        $thumb = $this->thumb;
        $file = $this->file;
        
        if(empty($file))
        {
            return FALSE;
        }
        
        $this->update();
        
        $this->cutphoto();
        
        $thumb_array = explode(',', $thumb);
        foreach($thumb_array as $key => $value)
        {
            if(!empty($value))
            {
                $string = str_replace('w', '', $value);
                $string = explode('h', $string);
                $width = $string[0];
                $height = $string[1];
                $this->cutphoto( array( 'width' => $width, 'height' => $height) );
            }
        }
        
        return TRUE;
    }
    
    //壓縮&縮圖
    private function cutphoto( $arg = array('width' => 0, 'height' => 0) )
    {
        $width = empty($arg['width']) ? 0 : $arg['width'];
        $height = empty($arg['height']) ? 0 : $arg['height'];
        $file = $this->file;
        $o_photo = $this->file['tmp_name'];
        $picid = $this->picid;
        $md5 = $this->md5;
        
        if(empty($file))
        {
            return FALSE;
        }
        
		$picid = abs(intval($picid));
		$picid = sprintf("%08d", $picid);
        
		$dir1 = substr($picid, 0, 2);
		$dir2 = substr($picid, 2, 2);
		$dir3 = substr($picid, 4, 2);
		$dir4 = substr($picid, 6, 2);
        
        $path1 = APPPATH.'./pic/'.$dir1;
        if( !is_dir($path1) ) mkdir($path1, 0777);
        $path2 = APPPATH.'./pic/'.$dir1.'/'.$dir2;
        if( !is_dir($path2) ) mkdir($path2, 0777);
        $path3 = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3;
        if( !is_dir($path3) ) mkdir($path3, 0777);
        
        if($width == 0 || $height == 0)
        {
            $width = 1900;
            $height = 1600;
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'.jpg';
        }
        else
        {
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5.'-w'.$width.'h'.$height.'.jpg';
        }
        
        if($data = getimagesize($o_photo)) {
            if($data[2] == 1) {
                $make_max = 0;//gif不处理
                if(function_exists("imagecreatefromgif")) {
                    $temp_img = imagecreatefromgif($o_photo);
                }
            } elseif($data[2] == 2) {
                if(function_exists("imagecreatefromjpeg")) {
                    $temp_img = imagecreatefromjpeg($o_photo);
                }
            } elseif($data[2] == 3) {
                if(function_exists("imagecreatefrompng")) {
                    $temp_img = imagecreatefrompng($o_photo);
                }
            }
        }
        if(!$temp_img) return '';
        
        $o_width = imagesx($temp_img);//取得原图宽
        $o_height = imagesy($temp_img);//取得原图高

        //判断处理方法
        if($width>$o_width || $height>$o_height)
        {
            //原图宽或高比规定的尺寸小,进行压缩
            $newwidth = $o_width;
            $newheight = $o_height;
            if($o_width > $width)
            {
                $newwidth = $width;
                $newheight = $o_height*$width/$o_width;
            }
            if($newheight > $height)
            {
                $newwidth = $newwidth*$height/$newheight;
                $newheight = $height;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);
            imagejpeg($new_img , $d_photo);
            imagedestroy($new_img);
        }
        else
        {
        //原图宽与高都比规定尺寸大,进行压缩后裁剪
            if($o_height*$width/$o_width>$height){
                //先确定width与规定相同,如果height比规定大,则ok
                $newwidth=$width;
                $newheight=$o_height*$width/$o_width;
                $x=0;
                $y=($newheight-$height)/2;
            }
            else
            {
                //否则确定height与规定相同,width自适应
                $newwidth=$o_width*$height/$o_height;
                $newheight=$height;
                $x=($newwidth-$width)/2;
                $y=0;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);

            imagejpeg($new_img , $d_photo);
            
            if($data = getimagesize($o_photo)) {
                if($data[2] == 1) {
                    $make_max = 0;//gif不处理
                    if(function_exists("imagecreatefromgif")) {
                        $temp_img = imagecreatefromgif($o_photo);
                    }
                } elseif($data[2] == 2) {
                    if(function_exists("imagecreatefromjpeg")) {
                        $temp_img = imagecreatefromjpeg($o_photo);
                    }
                } elseif($data[2] == 3) {
                    if(function_exists("imagecreatefrompng")) {
                        $temp_img = imagecreatefrompng($o_photo);
                    }
                }
            }
            if(!$temp_img) return '';
            
//            $o_width   = imagesx($temp_img);//取得缩略图宽
//            $o_height = imagesy($temp_img);//取得缩略图高
            
            //裁剪图片

            $new_imgx = imagecreatetruecolor($width,$height);
            imagecopyresampled($new_imgx,$new_img,0,0,0,0,$width,$height,$width,$height);
            imagejpeg($new_imgx , $d_photo);
            imagedestroy($new_img);
            imagedestroy($new_imgx);
        }
    }
    
	public function get_array()
	{
        $pic['picid'] = $this->picid;
        $pic['uid'] = $this->uid;
        $pic['title'] = $this->title;
        $pic['filename'] = $this->filename;
        $pic['thumb'] = $this->thumb;
        $pic['size'] = $this->size;
        $pic['classid'] = $this->classid;
        $pic['classid_array'] = $this->classid_array;
        $pic['type'] = $this->type;
        $pic['path'] = $this->path;
        $pic['md5'] = $this->md5;
        $pic['status'] = $this->status;
        
		return $pic;
	}
    
	public function update()
	{
        $pic2 = $this->get_array();
        
        if( empty($pic2['picid']) )
        {
            $pic2['picid'] = $this->common_model->db_search_max( array('table_name' => 'pic', 'id_name' => 'picid') ) + 1;
            $pic = array(
                'picid' => $pic2['picid'],
                'uid' => $pic2['uid'],
                'title' => $pic2['title'],
                'filename' => $pic2['filename'],
                'thumb' => $pic2['thumb'],
                'classid' => $pic2['classid'],
                'size' => $pic2['size'],
                'type' => $pic2['type'],
                'md5' => $pic2['md5'],
                'status' => $pic2['status']
            );
            
            $this->db->insert('pic', $pic);
            $this->picid = $pic['picid'];
        }
        else
        {
            $pic = array(
                'picid' => $pic2['picid'],
                'uid' => $pic2['uid'],
                'title' => $pic2['title'],
                'filename' => $pic2['filename'],
                'thumb' => $pic2['thumb'],
                'classid' => $pic2['classid'],
                'size' => $pic2['size'],
                'type' => $pic2['type'],
                'md5' => $pic2['md5'],
                'status' => $pic2['status']
            );
            
            $this->db->where(array('picid' => $pic['picid']));
            $this->db->update('pic', $pic);
        }
    }
    
    public function hidden()
    {
        $pic_array = $this->get_array();

        $this->db->where( array('picid' => $pic_array['picid'] ) );
        $this->db->update('pic', array('status' => 0) ); 
    }
    
    public function get_picid()
    {
        $picid = $this->picid;
        return $picid;
    }
	
}