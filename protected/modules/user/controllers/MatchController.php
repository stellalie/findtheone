<?php

class MatchController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all FTO models.
	 */

	public function actionIndex()
	{
        // if female find male, vice versa
        $gender = (Yii::app()->user->gender == "Male") ? "Female" : "Male";
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
                'select'=>"*",
                // grab only not-banned user and non-admins
		        'condition'=>'status>'.User::STATUS_BANNED.' AND '.'superuser=0'.' AND '.'gender="'.$gender.'"',
                'with' => array(
                    'profile' =>array('joinType'=>'LEFT JOIN')
                ),
		    ),
			'pagination'=>array(
				'pageSize'=>100,
			),
		));

        $similiarPeople = [];
        foreach($dataProvider->getData() as $data) {
            // calculate score
            $score = $this->calculateScore($data);
            // set id - score
            $similiarPeople[$data->id] = $score;
            arsort($similiarPeople);
        }

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'similiarPeople'=>$similiarPeople,
		));
	}

    public function calculateScore($data)
    {
        $my_age = $this->calculateAge(Yii::app()->user->dob);
        $my_city = Yii::app()->user->city;
        $my_state = Yii::app()->user->state;
        $my_postcode = Yii::app()->user->postcode;
        $my_hobbies = explode(",", Yii::app()->user->hobbies);
        $my_movies = explode(",", Yii::app()->user->movies);
        $my_musics = explode(",", Yii::app()->user->musics);
        $my_books = explode(",", Yii::app()->user->books);

        $score = 0;

        // based on age
        $person_age = $this->calculateAge($data->profile->dob);
        $age_diff = abs($my_age - $person_age);
        if ($age_diff > 15) {
            $score -= 2;
        }

        // based on states
        if (strtolower(trim($my_state)) == strtolower(trim($data->profile->state)))
            $score += 5;

        if (strtolower(trim($my_city)) == strtolower(trim($data->profile->city)))
            $score += 5;

        if (strtolower(trim($my_postcode)) == strtolower(trim($data->profile->postcode)))
            $score += 5;

        // based on hobby
        foreach($my_hobbies as $my_hobby) {
            foreach(explode("," ,$data->profile->hobbies) as $person_hobby) {
                if (strtolower(trim($my_hobby)) == strtolower(trim($person_hobby)))
                    $score += 3;
            }
        }

        // based on movies
        foreach($my_movies as $my_movie) {
            foreach(explode("," ,$data->profile->movies) as $person_movie) {
                if (strtolower(trim($my_movie)) == strtolower(trim($person_movie)))
                    $score += 3;
            }
        }

        // based on music
        foreach($my_musics as $my_music) {
            foreach(explode("," ,$data->profile->musics) as $person_music) {
                if (strtolower(trim($my_music)) == strtolower(trim($person_music)))
                    $score += 3;
            }
        }

        // based on books
        foreach($my_books as $my_book) {
            foreach(explode("," ,$data->profile->books) as $person_book) {
                if (strtolower(trim($my_book)) == strtolower(trim($person_book)))
                    $score += 3;
            }
        }

        return $score;
    }

    protected function calculateAge($dob)
    {
        list($year, $month, $day) = explode("-", $dob);
        $age = date("Y") - $year;
        return $age;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=User::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
