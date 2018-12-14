<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property Program[] $programs
 * @property StartProgram[] $startPrograms
 */
class ProgramStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Program::className(), ['program_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartPrograms()
    {
        return $this->hasMany(StartProgram::className(), ['program_status_id' => 'id']);
    }
}
