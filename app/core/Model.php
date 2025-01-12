<?php
class Model extends Database {

    protected $table          = '';
// protected $limit           = 5;
// protected $offset          = 0;
    protected $orderBy        = 'id';
    protected $orderType      = 'DESC';
    protected $allowedColumns = [];
    protected $errors         = [];  
    
    public function setErrors(){
        return $this->errors;
    }

    public function list($columns = [],$fetch_type=self::FETCH_OBJ){

        foreach($columns as $key => $col):

            if(!in_array($col,$this->allowedColumns,true)) unset($columns[$key]);

        endforeach;

        $columns = !empty($columns) ? implode(', ',$columns) : '*'; 

        $query   = "SELECT  $columns FROM {$this->table} ORDER BY {$this->orderBy} {$this->orderType}";
        
        return $this->query(query:$query,result_type:self::FETCH_ALL,fetch_type:$fetch_type);
    }

    public function where($where,$data,$columns = [],$result_type =self::FETCH_ALL,$fetch_type=self::FETCH_OBJ){

        foreach($columns as $key => $col):

            if(!in_array($col,$this->allowedColumns,true)) unset($columns[$key]);

        endforeach;

        $columns = !empty($columns) ? implode(', ',$columns) : '*'; 

        $query   = "SELECT $columns FROM {$this->table} WHERE $where ORDER BY {$this->orderBy} {$this->orderType}  ";
        
        foreach($data as $key => $value):

            if(!in_array($key,$this->allowedColumns,true)) unset($data[$key]);

        endforeach;

        return $this->query($query,$data,$result_type,$fetch_type);
    }
    
    public function first($value,$column='id',$columns=[], $fetch_type=self::FETCH_OBJ){

        foreach($columns as $key => $col):

            if(!in_array($col,$this->allowedColumns,true)) unset($columns[$key]);

        endforeach;

        $columns = !empty($columns) ? implode(', ',$columns) : '*'; 

        $query   = "SELECT  $columns FROM {$this->table} WHERE $column = '$value' LIMIT 1";
        
        return $this->query(query:$query,result_type:self::FETCH,fetch_type:$fetch_type);
    }

    public function is_exists($value,$column='id'){

        $query= "SELECT 1 AS is_found FROM {$this->table} WHERE $column = '$value' LIMIT 1";
        
        return $this->query(query:$query,result_type:self::ROW_COUNT) == 1;
    }

    public function destroy($value,$column='id'){
        
        $query= "DELETE FROM {$this->table} WHERE $column = '$value' ";

        return $this->query(query:$query,result_type:self::ROW_COUNT) > 0;
    }

    public function insert($data){

        $query= "INSERT INTO {$this->table} ( ";
        
        foreach($data as $key => $value):

            if(!in_array($key,$this->allowedColumns,true)) unset($data[$key]);

        endforeach;

        $columns = array_keys($data);

        $query.= implode(', ',$columns) . ' ) VALUES ( ';

        $values = '';

        foreach($columns as $column):

            $values .= ":$column, ";

        endforeach;

        $values = rtrim($values,', ').' );';

        $query.= $values;

        return $this->query($query,$data,self::LAST_INSERT_ID);

    }

    public function update($data,$value,$column='id'){

        $query= "UPDATE {$this->table} SET ";
        
        foreach($data as $key => $val):

            if($key == 'id') unset($data['id']);

            if(!in_array($key,$this->allowedColumns,true)) unset($data[$key]);

        endforeach;

        $columns = array_keys($data);

        $values = '';

        foreach($columns as $col):

            $values .= "$col = :$col, ";

        endforeach;

        $values = rtrim($values,', ')." WHERE $column = :$column ;";

        $query.= $values;

        $data[$column]=$value;

        return $this->query($query,$data,self::ROW_COUNT) > 0;


    }

    public function inner_join_between_2_tables($columnsTbl1=[] ,$columnsTbl2=[] , $tableName2 ,$fkColNameTbl1 , $pkColNameTbl2,  $alisTableName1 , $alisTableName2,$result_type =self::FETCH_ALL,$fetch_type=self::FETCH_OBJ){

        $columnsTbl1Text = '';
        $columnsTbl2Text = '';

        if(!empty($columnsTbl1)){

            foreach($columnsTbl1 as $column){

                $columnsTbl1Text.= $alisTableName1.'.'.$column.', ';
            }

            if(empty($columnsTbl1)){
                
                $columnsTbl1Text = rtrim($columnsTbl1Text,', ');
            }

        }

        if(!empty($columnsTbl2)){

            foreach($columnsTbl2 as $col){

                $columnsTbl2Text.= $alisTableName2.'.'.$col.', ';
            }

            $columnsTbl2Text = rtrim($columnsTbl2Text,', ');
     
        }
        
        $columns = $columnsTbl1Text.$columnsTbl2Text; 

        $columns = empty($columns) ? '*' : $columns; 

        $query   = "SELECT $columns FROM {$this->table} $alisTableName1 INNER JOIN $tableName2 $alisTableName2 ON $alisTableName1.$fkColNameTbl1 = $alisTableName2.$pkColNameTbl2";

        return $this->query($query,[],$result_type,$fetch_type);

    }

    public function stored_procedure($name,$params=[],$result_type=self::FETCH_ALL,$fetch_type=self::FETCH_OBJ){

        $query= "CALL $name ( ";
        
        foreach($params as $key => $value):

            if(!in_array($key,$this->allowedColumns,true)) unset($params[$key]);

        endforeach;

        $columns = array_keys($params);

        $values = '';

        foreach($columns as $column):

            $values .= ":$column, ";

        endforeach;

        $values = rtrim($values,', ').' );';

        $query.= $values;

        return $this->query($query,$params,$result_type,$fetch_type);

    }

    public function count($where=null){

        $query= "SELECT COUNT(*) FROM {$this->table}";

        if(!empty($where)){
            
            $query .= " WHERE $where";
        }
        
        return $this->query(query:$query,result_type:self::FETCH_COLUMN);
    }

}