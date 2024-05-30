<?php

    function get_Assignments_by_course($course_id){
        global $db;
        if($course_id){
            $query = 'SELECT A.ID , A.DESCRIPTION , C.courseName from assignments A LEFT JOIN courses C ON A.COURSEID=C.courseID
            WHERE A.COURSEID=:course_id ORDER BY A.ID';
        }else{
            $query = 'SELECT A.ID , A.DESCRIPTION , C.courseName from assignments A LEFT JOIN courses C ON A.COURSEID=C.courseID
             ORDER BY C.courseID';
        }
        $statement=$db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();
        $assignments=$statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }

    function dele_assignment($assignment_id){
        global $db;
        $query='DELETE FROM assignments WHERE ID=:assignment_id';
        $statement=$db->prepare($query);
        $statement->bindValue(':assignment_id',$assignment_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_assignment($course_id,$description){
        global $db;
        $query='INSERT INTO assignments (DESCRIPTION,COURSEID) VALUES (:descr,:courseID)';
        $statement=$db->prepare($query);
        $statement->bindValue(':descr',$description);
        $statement->bindValue(':courseID',$course_id);
        $statement->execute();
        $statement->closeCursor();
    }