<?php
namespace Home\Controller;
use Home\Controller\MyController;

Class NewsController extends MyController
{
    /**
     * 资讯列表
     * @param isFirst integer 是否头条（0否  1是）*/
    public function topStories()
    {
        $isFirst = $_GET['isFirst'] == '' ? 1 : $_GET['isFirst'];
        $page = $_GET['page'] == '' ? 1 : $_GET['page'];
        $page = $page < 1 ? 1 : $page;
        $pageSize = $_GET['pageSize'] == '' ? 10 : $_GET['pageSize'];
        $offset = ($page - 1) * $pageSize;
    
        $sql = "select id,title,ifnull(comment_count,0) AS comment_count,ifnull(view_count,0) AS view_count,ptime,ifnull(update_date,'') AS update_date,isTop,isFirst,template,urlType,ifnull(url,'') url
        from lzd_sys_news where isFirst = $isFirst and state = 1 AND (library_id is null or library_id not in (select id from lzd_news_library where type = 1))
        order by isTop DESC ,ptime desc limit $offset, $pageSize";
        $data['lists'] = M()->query($sql);
    
        foreach ($data['lists'] as $k => $v)
        {
            $data['lists'][$k]['ptime'] = date('Y-m-d',strtotime($v['ptime']));
            $data['lists'][$k]['images'] = $this->get_news_images($v['id']);
        }
    
        //echo json_encode($data);
        $this->ajaxReturn($this->errmsg(10000, '成功', $data));
    }
    
    /**
     * 资讯详情页面
     * @param id 资讯id
     */
    public function view()
    {
        $id = $_GET['id'];
    
        if(!$id)
        {
            $this->ajaxReturn($this->errmsg(10001, "请选择要查看的资讯"));
        }
        
        $sql = "select s.id,s.title,s.content,s.ptime,
        ifnull(s.update_date,'') AS update_date,
        ifnull(s.view_count,0) AS view_count,
        ifnull(s.collect_count,0) AS collect_count,
        ifnull(s.follow_count,0) AS follow_count,
        ifnull(s.praise_count,0) AS  praise_count,
        s.comment_count,
        ifnull(s.penname,'') AS penname
        from lzd_sys_news s
        LEFT JOIN lzd_news_comment c ON c.relation_id = s.id
        WHERE s.id = $id AND s.state = 1";
        
        
        $detail = M()->query($sql);
        $data['detail'] = $detail[0];
    
        $data['detail']['is_like'] =  false;

        if (empty($data['detail']))
        {
            $this->ajaxReturn($this->errmsg(10001, "资讯已被删除"));
        }
        $data['detail']['images'] = $this->get_news_images($id);
        //$data['detail']['ptime']  = date('Y-m-d',strtotime($data['detail']['ptime']));
        
        //preg_match('(.*?)</style@',$data['detail']['content'],$find);
        //var_dump($find);exit;
        
        $this->ajaxReturn($this->errmsg(10000, '成功', $data));
    }
    
    /**
     * 资讯评论
     * @param id 资讯id*/
    public function newComment()
    {
        $id = $_GET['id'];
        $page = $_GET['page'] == '' ? 1 : $_GET['page'];
        $page = $page < 1 ? 1 : $page;
        $pageSize = $_GET['pageSize'] == '' ? 10 : $_GET['pageSize'];
        $offset = ($page - 1) * $pageSize;
        
        $sql = "select c.id,c.content,c.praise_count,c.reply_count,c.create_date,u.id user_id,u.username user_name,
        ifnull(i.thumbnail,'') thumbnail,ifnull(i.original,'') original
        from lzd_news_comment c
        LEFT JOIN lzd_user u on c.member_id = u.id
        LEFT JOIN lzd_cover_image i ON u.portrait_id = i.id
        where c.relation_id = $id and c.parent_id = 0 AND c.type = 1 ORDER BY c.id DESC limit $offset,$pageSize";
        
        $data = M()->query($sql);
        foreach($data as $k => $v)
        {
            $data[$k]['create_date'] = date('Y-m-d', strtotime($v['create_date']));           
        }
        
        $this->ajaxReturn($this->errmsg(10000, '成功', $data));
    }
    
    /**
     * @param $id
     * @return mixed
     * 资讯图片列表
     */
    private function get_news_images($id)
    {
        $sql = "select image_url from lzd_news_image WHERE news_id = $id";
        return M()->query($sql);
    }
    
    /**
     * 用户访问记录
     * @param $id  资询ID
     * @param $uid 用户ID
     * @param $ip  访问IP*/
    private function user_ip($id,$uid,$ip)
    {
        $sql = "insert into lzd_news_ip (news_id, user_id, ip) values ($id, $uid, '$ip')";
        return M()->query($sql);
    }
    
    /**
     * 游客访问记录
     * @param $id  资询ID
     * @param $ip  访问IP*/
    private function visitor_ip($id,$ip)
    {
        $sql = "insert into lzd_news_ip (news_id, ip) values ($id, '$ip')";
        return M()->query($sql);
    }
}