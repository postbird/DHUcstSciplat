<?php
/*
 * 用户与角色关联模型
 */
Class UserRelationModel extends RelationModel{
	
		//定义主表名称
	Protected $tableName='user';
	//定义关联关系
	Protected $_link=array(
			'role'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'role',
					'foreign_key'=>'user_id',//主表在中间表的字段名称
					'relation_foreign_key'=>'role_id',//副表在中间表的字段 名称
					'relation_table'=>'sp_role_user',//中间表
					'mapping_fields'=>'id,name,remark',
			),
			'elite'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'elite',
					'foreign_key'=>'user_id',//主表在中间表的字段名称
					'relation_foreign_key'=>'elite_id',//副表在中间表的字段 名称
					'relation_table'=>'sp_elite_user',//中间表
					'mapping_fields'=>'eid,ename',
			),
			'project'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'project',
					'foreign_key'=>'user_id',//主表在中间表的字段名称
					'relation_foreign_key'=>'project_id',//副表在中间表的字段 名称
					'relation_table'=>'sp_project_user',//中间表
					'mapping_fields'=>'pid',
			),
			
	);
	
}