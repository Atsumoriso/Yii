<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%tbl_post}}".
 *
 * @property string $id
 * @property string $title
 * @property string $anons
 * @property string $content
 * @property string $category_id
 * @property string $author_id
 * @property string $publish_status
 * @property string $publish_date
 *
 * @property TblCategory $category
 * @property TblUser $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['anons', 'content', 'publish_status'], 'string'],
            [['category_id', 'author_id'], 'integer'],
            [['publish_date'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'anons' => 'Anons',
            'content' => 'Content',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'publish_status' => 'Publish Status',
            'publish_date' => 'Publish Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TblCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'author_id']);
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
        ]);
    }
}
