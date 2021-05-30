<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\models\Supplier;


/**
* SignupForm is the model behind the login form.
*/

class SupplierForm extends Model
{    
    public $cylinder_type;  
    public $cylinder_quantity;  
    public $cylinder_price;
    public $cylinder_status;
    public $created;
    public $updated;      
   
   
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['cylinder_type', ' cylinder_quantity', 'cylinder_price', 'cylinder_status'], 'required'],
            [['created', 'updated'], 'safe'],
            [['cylinder_type', ' cylinder_quantity'], 'string', 'max' => 255],
            [['cylinder_price'], 'string', 'max' => 50],
            [['cylinder_status'], 'string', 'max' => 100],
        ];
    }
    
    /**
     * Logs in a user using the provided email and password.
     * @return boolean whether the user is logged in successfully
     */
    public function supplier()
    {
        if ($this->validate()) {
            $model = new Supplier();
            $model->cylinder_type = $this->cylinder_type;
            $model->cylinder_quantity = $this->cylinder_quantity;
            $model->cylinder_price = $this->cylinder_price;                                
            $model->cylinder_status = $this->cylinder_status;                                
            $model->created = date('Y-m-d h:i:s');
            $model->updated = date('Y-m-d h:i:s');
            if($model->save()){
                return true;
            }
            else{
                return false;	
            }
        }
        return false;
    }	
  

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cylinder_type' => 'Cylinder Type',
            ' cylinder_quantity' => 'Cylinder Quantity',
            'cylinder_price' => 'Cylinder Price',
            'cylinder_status' => 'Cylinder Status',
            'created' => 'Created',
            'updated' => 'Updated',
           
        ];
    }    
}
