<?php

namespace app\models\productsimage;

/**
 * This is the ActiveQuery class for [[ProductsImage]].
 *
 * @see ProductsImage
 */
class ProductsImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductsImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductsImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
