<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program_item".
 *
 * @property int $id
 * @property int $program_detail_id
 * @property int $feeder_id
 * @property string $comment
 * @property int $amount
 * @property string $part_no
 * @property string $size
 *
 * @property Feeder $feeder
 * @property Item $partNo
 * @property ProgramDetail $programDetail
 */
class ProgramItem extends \yii\db\ActiveRecord
{
  /*Import variable*/
 public $customer;
  public $models;
  public $machine;
  public $tblmc;
  public $program;
  //public $feeder;
  /*test*/
  /*End*/
  //public $program;
  public $directiion;
  public $tbl;
  //public $customer;
  // public $part_type;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
      return 'program_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
          // [['program_detail_id', 'feeder_id', 'comment', 'amount', 'part_no','tbl','size'], 'required'],
        [['program_detail_id', 'feeder_id', 'amount','directiion','part_type','models','tblmc'], 'integer'],
        [['comment','size'], 'string'],
        [['part_no'], 'string', 'max' => 100],
        [['feeder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feeder::className(), 'targetAttribute' => ['feeder_id' => 'id']],
        [['part_no'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['part_no' => 'part_no']],
        [['program_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramDetail::className(), 'targetAttribute' => ['program_detail_id' => 'id']],
        [['part_type'], 'exist', 'skipOnError' => true, 'targetClass' => PartType::className(), 'targetAttribute' => ['part_type' => 'id']],
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'program_detail_id' => 'Program Detail ID',
        'feeder_id' => 'Feeder ID',
        'comment' => 'Comment',
        'amount' => 'Amount',
        'part_no' => 'Part No',
        'program'=>'program',
        'size'=>'size',
        // 'part_type'=>'PartType'
      ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeder()
    {
      return $this->hasOne(Feeder::className(), ['id' => 'feeder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartNo()
    {
      return $this->hasOne(Item::className(), ['part_no' => 'part_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetail()
    {
      return $this->hasOne(ProgramDetail::className(), ['id' => 'program_detail_id']);
    }
    
    public function getProgram()
    {
      return $this->hasOne(Program::className(), ['id' => 'program']);
    }
    public function getPartType()
    {
      return $this->hasOne(PartType::className(), ['id' => 'part_type']);
    }
  }
