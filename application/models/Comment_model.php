<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 16:03
 */

class Comment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_last_five_comments($user_id = FALSE)
    {
        $user = '';
        if ($user_id) $user = 'AND `user_id` = '.$user_id;

        $sql = "SELECT `com`.*, `u`.`name`, `th`.theme_name FROM
                 (SELECT `t2`.*
                  FROM (
                      SELECT `id`
                      FROM `comments`
                      WHERE `parent_id` = 0 ".$user."
                      ORDER BY `id` DESC
                      LIMIT 5
                  ) AS `t1`
                  JOIN `comments` AS `t2`
                  ON `t2`.`id` = `t1`.`id` OR `t2`.`parent_id` = `t1`.`id`
                  ORDER BY `t2`.`date` ASC) AS `com`
                  JOIN `users` AS `u` JOIN `theme` AS `th`
                  ON `com`.`user_id` = `u`.`id` AND  `com`.`theme_id` = `th`.`id`";

        $query = $this->db->query($sql);

        $comments = array();

        foreach ($query->result() as $comment)
        {
            if ($comment->parent_id == 0)
            {
                $comments[$comment->id] = $comment;
            }
            else
            {
                $comments[$comment->parent_id]->subComments[$comment->id] = $comment;
            }
        }
        $comments = $this->reverse($comments);
        return $comments;
    }

    public function all_comments($user_id = FALSE)
    {
        $user = '';
        if ($user_id)
        {
            $user = 'AND `user_id` = '.$user_id;
            $this->db->where(['parent_id' => 0, 'user_id' => $user_id]);
        }
        else
        {
            $this->db->where('parent_id', 0);
        }


        $count = $this->db->count_all_results('comments');
        if ($count > 5) $count -= 5;

        $sql = "SELECT `com`.*, `u`.`name`, `th`.theme_name FROM
                 (SELECT `t2`.*
                  FROM (
                      SELECT `id`
                      FROM `comments`
                      WHERE `parent_id` = 0 ".$user."
                      ORDER BY `id` DESC
                      LIMIT 5, ".$count."
                  ) AS `t1`
                  JOIN `comments` AS `t2`
                  ON `t2`.`id` = `t1`.`id` OR `t2`.`parent_id` = `t1`.`id`
                  ORDER BY `t2`.`date` ASC) AS `com`
                  JOIN `users` AS `u` JOIN `theme` AS `th`
                  ON `com`.`user_id` = `u`.`id` AND  `com`.`theme_id` = `th`.`id`";
        $query = $this->db->query($sql);


        foreach ($query->result() as $comment)
        {
            if ($comment->parent_id == 0)
            {
                $comments[$comment->id] = $comment;
            }
            else
            {
                $comments[$comment->parent_id]->subComments[$comment->id] = $comment;
            }
        }
        $comments = $this->reverse($comments);

        return $comments;
    }

    public function user_comments($user_id)
    {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where(['user_id'=> $user_id, 'del_com' => 1]);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_comment($data)
    {
        if ($this->db->insert('comments', $data))
        {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function delete_comment($id, $parent_id)
    {

        if ($parent_id == 0)
        {
            $data = ['del_com' => 0];
            $where = 'id = '.$id;

            $res = $this->db->update_string('comments', $data, $where);
            return $this->db->query($res);
        }
        else
        {
            return $this->db->delete('comments', ['id' => $id]);
        }
    }

    private function reverse($comments)
    {
        $comments = array_reverse($comments, TRUE);
        foreach ($comments as $comment)
        {
            if (isset($comment->subComments))
            {
                $comments[$comment->id]->subComments = array_reverse($comments[$comment->id]->subComments, TRUE);
            }
        }

        return $comments;
    }

    public function count_comments($user_id = FALSE)
    {
        if ($user_id)
        {
            $this->db->where(['parent_id' => 0, 'user_id' => $user_id]);
        }
        else
        {
            $this->db->where('parent_id', 0);
        }
        return $this->db->count_all_results('comments');
    }
}