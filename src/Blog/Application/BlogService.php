<?php
namespace Blog\Application;

use Blog\Domain\Model\Blog;

interface BlogService
{
    /**
     * 查询试卷数据
     * 
     * @param int $studentId
     * @param int $paperId
     * @param string[] $attributes
     * @return PaperData
     */
    function fetchBlog($page, $limit, $cid);

}