<?php

class Home {

    /**
     *This method loads the homepage
     *@param int $id The user id
     *@throws \Exception If the user id doesn't exist
     *@return void
     */
    public function index( $id)
    {
        htmlspecialchars($id,ENT_QUOTES);
        htmlentities($id);
        addslashes($id);  //添加反斜杠
        stripslashes($id); //函数删除由 addslashes() 函数添加的反斜杠。
    }

}

echo htmlspecialchars('<script>alert("11223,齐朝阳") </script>',ENT_QUOTES);//默认"UTF-8"
echo htmlspecialchars_decode(htmlspecialchars('<script>alert("11223,齐朝阳")</script>',ENT_QUOTES)); //
echo htmlentities('<script>alert("11223,齐朝阳") </script>',ENT_QUOTES,"UTF-8");

$object = new Home();

//get the comment string
$comment_string= (new ReflectionClass($object))->getMethod('index')->getdoccomment();

//define the regular expression pattern to use for string matching
$pattern = "#(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_].*)#";

//perform the regular expression on the string provided
preg_match_all($pattern, $comment_string, $matches, PREG_PATTERN_ORDER);

echo "<pre>"; print_r($matches);