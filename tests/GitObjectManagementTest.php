<?php
/*
 * This file is part of the PECL_Git package.
 * (c) Shuhei Tanuma
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
 /*
Git revision object management routines

 [*]git_object_write(Implemented at GitBlob)
 [*]git_object_id(Implemented at GitBlob)
 []git_object_type
 []git_object_owner
 [-]git_object_free
 [*]git_object_type2string (git_type_to_string)
 [*]git_object_string2type (git_string_to_type)
 [-]git_object_typeisloose
 */
class GitObjectManagementTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // currentry nothing to do.
    }
     
    protected function tearDown()
    {
        // currentry nothing to do.
    }
    
    public function testObjectGetId()
    {
        $git = new Git\Repository(".git");
        //$this->markTestIncomplete("getObjectで問題が発生している");
        $obj = $git->getObject("6c4a06776164f960307341033a7e5271c0b2c669");
        $this->assertEquals("6c4a06776164f960307341033a7e5271c0b2c669", $obj->getId());
    }
     
    /**
     * @dataProvider getStringToTypeSpecifications
     */
    public function testStringToType($expected, $str_type, $comment)
    {
        $this->assertEquals($expected, git_string_to_type($str_type), $comment);
    }
     
    public function getStringToTypeSpecifications()
    {
        $array = array();
        $array[] = array(Git\Object\Commit,"commit","commit type id");
        $array[] = array(Git\Object\Blob,  "blob",  "blob type id");
        $array[] = array(Git\Object\Tree,  "tree",  "tree type id");
        $array[] = array(Git\Object\Tag,   "tag",   "tag type id");

        return $array;
    }
     
    /**
     * @dataProvider getTypeToStringSpecifications
     */
    public function testTypeToString($expected, $type, $comment)
    {
        $this->assertEquals($expected, git_type_to_string($type), $comment);
    }

    public function getTypeToStringSpecifications()
    {
        $array = array();
        $array[] = array("commit",Git\Object\Commit,"commit type string");
        $array[] = array("blob",  Git\Object\Blob,  "blob type string");
        $array[] = array("tree",  Git\Object\Tree,  "tree type string");
        $array[] = array("tag",   Git\Object\Tag,   "tag type string");
        return $array;
    }

}