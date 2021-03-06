<?php
require_once 'Customweb/Database/Driver/AbstractStatement.php';
require_once 'Customweb/Database/IStatement.php';


class Customweb_Database_Driver_PDO_Statement extends Customweb_Database_Driver_AbstractStatement implements Customweb_Database_IStatement {

	/**
	 *
	 * @var PDOStatement
	 */
	private $statement;


	final protected function executeQuery() {
		if (!$this->isQueryExecuted()) {
			$this->statement = $this->getDriver()->getPdo()->query($this->prepareQuery());

			if ($this->statement === false) {
				$error = $this->getDriver()->getPdo()->errorInfo();
				throw new Exception($error[2]);
			}
			$this->setQueryExecuted();
		}
	}

	protected function getPdoStatement() {
		return $this->statement;
	}


	public function getInsertId() {
		$this->executeQuery();
		return $this->getDriver()->getPdo()->lastInsertId();
	}

	public function getRowCount() {
		$this->executeQuery();
		return $this->statement->rowCount();
	}

	public function fetch() {
		$this->executeQuery();
		$rs = $this->statement->fetch(PDO::FETCH_ASSOC);
		if ($rs === null) {
			return false;
		}
		else {
			return $rs;
		}
	}

	/**
	 * @return Customweb_Database_Driver_PDO_Driver
	 */
	public function getDriver() {
		return parent::getDriver();
	}

}