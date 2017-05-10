<?php
  require('../../myb4g-connect.php');
  require('../php/library.php');
  require('../classes/QueryDatabase.php');
  require('../classes/CreateTable.php');
  require('../classes/AddWeighIn.php');

  class WeighIn{
    public $connection;
    public $id;
    public $competitor_id;
    public $week_id;
    public $begin;
    public $previous;
    public $current;
    public $team_id;
    public $competition_id;
    public $notes;
    public $table_name;
    public $column_data;
    public $weigh_in_data;

    public function __construct($table_data, $weigh_in_data){
      $this->connection       = $table_data['connection'];
      $this->table_name       = $table_data['table_name'];
      $this->column_data      = $table_data['column_data'];
      $this->id               = $weigh_in_data['id'];
      $this->competitor_id    = $weigh_in_data['competitor_id'];
      $this->week_id          = $weigh_in_data['week_id'];
      $this->begin            = $weigh_in_data['begin'];
      $this->previous         = $weigh_in_data['previous'];
      $this->current          = $weigh_in_data['current'];
      $this->team_id          = $weigh_in_data['team_id'];
      $this->competition_id   = $weigh_in_data['competition_id'];
      $this->notes            = $weigh_in_data['notes'];
      $this->create_wi_table();
      $this->add_wi_data();
    }
    public function create_wi_table(){
      $table_properties = array(
        'connection'  =>  $this->connection,
        'table_name'  =>  $this->table_name,
        'column_data' =>  $this->column_data
      );
      prewrap($table_properties);
      $table = new CreateTable($table_properties);
    }
    public function set_wi_data(){
      $this->weigh_in_data = array(
        'connection'       => $this->connection,
        'id'               => $this->id,
        'competitor_id'    => $this->competitor_id,
        'week_id'          => $this->week_id,
        'begin'            => $this->begin,
        'previous'         => $this->previous,
        'current'          => $this->current,
        'team_id'          => $this->team_id,
        'competition_id'   => $this->competition_id,
        'notes'            => $this->notes
      );
    }
    public function add_wi_data(){
      $this->set_wi_data();
      $table = new AddWeighIn($this->weigh_in_data);
      if($table){echo('SUCCESS!!!');}else{echo('ERROR!!!');}
    }
  }

  $column_data  = array(
    array(
      'column_name'  => 'id',
      'column_type'  => 'INT UNSIGNED NOT NULL AUTO_INCREMENT'
    ),
    array(
      'column_name'  => 'competitor_id',
      'column_type'  => 'INT UNSIGNED NOT NULL'
    ),
    array(
      'column_name'  => 'week_id',
      'column_type'  => 'INT UNSIGNED NOT NULL'
    ),
    array(
      'column_name'  => 'begin',
      'column_type'  => 'DECIMAL(4,1)'
    ),
    array(
      'column_name'  => 'previous',
      'column_type'  => 'DECIMAL(4,1)'
    ),
    array(
      'column_name'  => 'current',
      'column_type'  => 'DECIMAL(4,1)'
    ),
    array(
      'column_name'  => 'team_id',
      'column_type'  => 'INT UNSIGNED NOT NULL'
    ),
    array(
      'column_name'  => 'competition_id',
      'column_type'  => 'INT UNSIGNED NOT NULL'
    ),
    array(
      'column_name'  => 'notes',
      'column_type'  => 'TEXT'
    )
  );

  $table_name = 'weigh_in';
  $table_data = array(
    'connection'  =>  $connection,
    'table_name'  =>  $table_name,
    'column_data' =>  $column_data
  );
  $weigh_in_data = array(
    'id'              =>  '1',
    'competitor_id'   =>  '1',
    'week_id'         =>  '1',
    'begin'           =>  '232.2',
    'previous'        =>  '227.8',
    'current'         =>  '224.5',
    'team_id'         =>  '1',
    'competition_id'  =>  '1',
    'notes'           =>  'These are the weigh in notes...'
  );

$wi = new WeighIn($table_data, $weigh_in_data);
prewrap($wi);
 ?>
