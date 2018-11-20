<?php

class Audit {

	public $id;
	public $ip;
	public $actionDesc;
	public $request;
	public $dateCreated;
	public $userType;
	public $userId;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['AUDIT_ID'];
			$this->ip = $array['AUDIT_IP'];
			$this->actionDesc = $array['AUDIT_ACTION_DESC'];
			$this->request = $array['AUDIT_REQUEST'];
			$this->dateCreated = $array['AUDIT_CREATED'];
			$this->userType = $array['USER_TYPE'];
			$this->userID = $array['USER_ID'];
		}
  }

	public function __destruct(){

	}

	public function getAuditWithID($paramAudit){

		$DB = fnDBConn();

		$SQL = "SELECT
							AUD.ID AS AUDIT_ID,
							AUD.IP AS AUDIT_IP,
							AUD.ACTION_DESC AS AUDIT_ACTION_DESC,
							AUD.REQUEST AS AUDIT_REQUEST,
							AUD.DIN AS AUDIT_CREATED,
							AUD.USER_TYPE AS USER_TYPE
							AUD.ID_USER AS USER_ID
						FROM
							AUDIT AS AUD
						WHERE
							AUD.ID = $paramAudit
						ORDEY BY
							AUD.DIN DESC";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$audit = new Audit($RESULT);

		return $audit;
	}

	public function getAllAudits(){

		$DB = fnDBConn();

		$SQL = "SELECT
							AUD.ID AS AUDIT_ID,
							AUD.IP AS AUDIT_IP,
							AUD.ACTION_DESC AS AUDIT_ACTION_DESC,
							AUD.REQUEST AS AUDIT_REQUEST,
							AUD.DIN AS AUDIT_CREATED,
							AUD.ID_USER AS USER_ID
						FROM
							AUDIT AS AUD
						WHERE
							1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrAudits = [];

		foreach ($RESULT as $KEY => $ROW) {
			$audit = new Audit($ROW);
			array_push($arrAudits, $audit);
		}

		return $arrAudits;
	}

}
?>
