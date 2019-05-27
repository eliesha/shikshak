<?php 
abstract class Database{
		protected $conn = null;
		protected $stmt = null;
		protected $sql = null;
		protected $table = null;
		public function __construct(){
			try {
				/********Connection Setup*************/
				$this->conn = new PDO(DSN, DB_USER, DB_PWD);
				$this->conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->stmt = $this->conn->prepare('SET NAMES utf8');
				$this->stmt->execute();
			} catch (PDOException $e) {
				error_log(
					date('Y-m-d h:i:s A').", Conection Setup: ".$e->getMessage()."\r\n"
					, 3, ERROR_PATH.'/error.log');
				return false;
			} catch (Exception $e) {
				error_log(
					date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
					, 3, ERROR_PATH.'/error.log');
				return false;
			}
		}

		final protected function create($sql){
			try {
				$this->sql = $sql;
				if (empty($this->sql)) {
					throw new Exception('Empty query.');
				}
				$this->stmt = $this->conn->prepare($this->sql);
				return $this->stmt->execute();
			} catch (PDOException $e) {
				error_log(
					date('Y-m-d h:i:s A').", Conection Setup: ".$e->getMessage()."\r\n"
					, 3, ERROR_PATH.'/error.log');
				return false;
			} catch (Exception $e) {
				error_log(
					date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
					, 3, ERROR_PATH.'/error.log');
				return false;
			}
		}

		final protected function table($_table){
			$this->table = $_table;
		}

		final protected function select($args = array(), $is_die = false){
			try {
			
			$this->sql = "SELECT ";
			if (isset($args['fields'])) {
				if (is_array($args['fields'])) {
					$this->sql .= implode(', ', $args['fields']);
				} else {
					$this->sql .= $args['fields'];
				}
			} else {
				$this->sql .= " * ";
			}
			$this->sql .= " FROM ";
			if (!isset($this->table) || empty($this->table)) {
				throw new Exception("Table not set");
			}
			$this->sql .= $this->table;

			/*Join Query*/
			if (isset($args['join']) && !empty($args['join'])) {
				$this->sql .= " ".$args['join'];
			}
			/*Join Query*/

			if (isset($args['where']) && !empty($args['where'])) {
				if (is_array($args['where'])) {
					$temp = array();
					foreach ($args['where'] as $column_name => $data) {
                        if (!is_array($data)) {
                            $data = array(
                                'value'     => $data,
                                'operator'  => '=',
                            );
                        }
                        $str = $column_name.' '.$data['operator'].' :'.str_replace('.', '_', $column_name);
                        $temp[] = $str;
                    }
					$this->sql .= " WHERE ".implode(' AND ', $temp);
				} else {
					$this->sql .= " WHERE ".$args['where'];
				}
			}

			/*Group*/
			if (isset($args['group_by']) && !empty($args['group_by'])) {
				$this->sql .= " GROUP BY ".$args['group_by'];
			}
			/*Group*/

			/*Order*/
			if (isset($args['order_by']) && !empty($args['order_by'])) {
				$this->sql .= " ORDER BY ".$args['order_by'];
			} else {
				$this->sql .= " ORDER BY ".$this->table.".id DESC";
			}
			/*Order*/

			/*Limit*/
			if (isset($args['limit']) && !empty($args['limit'])) {
				if (is_array($args['limit'])) {
					$this->sql .= " LIMIT ".$args['limit'][0].",".$args['limit'][1];
				} else {
					$this->sql .= " LIMIT ".$args['limit'];
				}
			}
			/*Limit*/
			$this->stmt = $this->conn->prepare($this->sql);
			if (is_array($args['where']) || is_object($args['where'])){
			    
			    foreach ($args['where'] as $column_name => $data) {
                $value = is_array($data) ? $data['value'] : $data; //check if passed where statement was an array, fetch value if so
                if (is_int($value)) {
                    $param = PDO::PARAM_INT;
                }elseif (is_bool($value)) {
                    $param = PDO::PARAM_BOOL;
                }elseif (is_null($value)) {
                    $param = PDO::PARAM_NULL;
                }else {
                    $param = PDO::PARAM_STR;
                }
                if ($param) {
                    $this->stmt->bindValue(":".str_replace('.', '_', $column_name), $value, $param);
                }
            }
			    
			}
			
			if ($is_die) {
	
				echo $this->sql;
	
			}
			
			$this->stmt->execute();
			$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;
			} catch (PDOException $e) {
					error_log(
						date('Y-m-d h:i:s A').", Select Query: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				} catch (Exception $e) {
					error_log(
						date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				}
		}

		final protected function update($data, $args = array(), $is_die = false){
			try {
				$this->sql = "UPDATE ";
				if (!isset($this->table) || empty($this->table)) {
					throw new Exception("Table not set");
				}
				$this->sql .= $this->table;
				$this->sql .= " SET ";
				if (isset($data) && !empty($data)) {
					if (is_array($data)) {
						$temp = array();
						$counter = 0;
						foreach ($data as $column_name => $value) {
							$str = $column_name." = :".$column_name."_".$counter;
							$temp[] = $str;
						}
						$this->sql .= implode(', ', $temp);
					} else {
						$this->sql .= $data;
					}
				}
				if (isset($args['where']) && !empty($args['where'])) {
					if (is_array($args['where'])) {
						$temp = array();
						foreach ($args['where'] as $column_name => $value) {
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}
						$this->sql .= " WHERE ".implode(' AND ', $temp);
					} else {
						$this->sql .= " WHERE ".$args['where'];
					}
				}
				$this->stmt = $this->conn->prepare($this->sql);
				if (isset($data) && !empty($data) && is_array($data)) {
					$counter = 0;
					foreach ($data as $column_name => $value) {
						if (is_int($value)) {
							$param = PDO::PARAM_INT;
						} elseif (is_bool($value)) {
							$param = PDO::PARAM_BOOL;
						} elseif (is_null($value)) {
							$value = null;
							$param = PDO::PARAM_INT;
						} else {
							$param = PDO::PARAM_STR;
						}
						if ($param) {
							$this->stmt->bindValue(":".$column_name."_".$counter, $value, $param);
						}
					}
				}
				if (isset($args['where']) && !empty($args['where']) && is_array($args['where'])) {
					foreach ($args['where'] as $column_name => $value) {
						if (is_int($value)) {
							$param = PDO::PARAM_INT;
						} elseif (is_bool($value)) {
							$param = PDO::PARAM_BOOL;
						} elseif (is_null($value)) {
							$param = PDO::PARAM_NULL;
						} else {
							$param = PDO::PARAM_STR;
						}
						if ($param) {
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				if ($is_die) {
					echo $this->sql;
				}
				return $this->stmt->execute();
			} catch (PDOException $e) {
					error_log(
						date('Y-m-d h:i:s A').", Update Query: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				} catch (Exception $e) {
					error_log(
						date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				}
		}

		final protected function insert($data, $is_die = false){
			try {
				$this->sql = "INSERT INTO ";
				if (!isset($this->table) || empty($this->table)) {
					throw new Exception("Table not set");
				}
				$this->sql .= $this->table;
				$this->sql .= " SET ";
				if (isset($data) && !empty($data)) {
					if (is_array($data)) {
						$temp = array();
						foreach ($data as $column_name => $value) {
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}
						$this->sql .= implode(', ', $temp);
					} else {
						$this->sql .= $data;
					}
				}
				$this->stmt = $this->conn->prepare($this->sql);
				if (isset($data) && !empty($data) && is_array($data)) {
					foreach ($data as $column_name => $value) {
						if (is_int($value)) {
							$param = PDO::PARAM_INT;
						} elseif (is_bool($value)) {
							$param = PDO::PARAM_BOOL;
						} elseif (is_null($value)) {
							$value = null;
							$param = PDO::PARAM_INT;
						} else {
							$param = PDO::PARAM_STR;
						}
						if ($param) {
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				if ($is_die) {
					echo $this->sql;
				}
				
				$this->stmt->execute();
				return $this->conn->lastInsertId();
			} catch (PDOException $e) {
					error_log(
						date('Y-m-d h:i:s A').", Insert Query: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'error.log');
					return false;
				} catch (Exception $e) {
					error_log(
						date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
			}
		} 

		final protected function delete($args, $is_die = false){
			try {
								
				$this->sql = "DELETE FROM ";
				if (!isset($this->table) || empty($this->table)) {
					throw new Exception("Table not set");
				}
				$this->sql .= $this->table;
				if (isset($args['where']) && !empty($args['where'])) {
					if (is_array($args['where'])) {
						$temp = array();
						foreach ($args['where'] as $column_name => $value) {
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}
						$this->sql .= " WHERE ".implode(' AND ', $temp);
					} else {
						$this->sql .= " WHERE ".$args['where'];
					}
				}
				$this->stmt = $this->conn->prepare($this->sql);
				if (isset($args['where']) && !empty($args['where']) && is_array($args['where'])) {
					foreach ($args['where'] as $column_name => $value) {
						if (is_int($value)) {
							$param = PDO::PARAM_INT;
						} elseif (is_bool($value)) {
							$param = PDO::PARAM_BOOL;
						} elseif (is_null($value)) {
							$value = NULL;
							$param = PDO::PARAM_INT;
						} else {
							$param = PDO::PARAM_STR;
						}
						if ($param) {
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				if ($is_die) {
					echo $this->sql;
				}
				return $this->stmt->execute();
			} catch (PDOException $e) {
					error_log(
						date('Y-m-d h:i:s A').", Select Query: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				} catch (Exception $e) {
					error_log(
						date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
						, 3, ERROR_PATH.'/error.log');
					return false;
				}
		}
		final protected function count($args = array(), $is_die = false){
				try {
				/*SELECT fields FROM table
				join statement
				WHERE clause
				GROUP BY clause
				ORDER BY clause
				LIMIT start, count*/			
				$this->sql = "SELECT ";
				if (isset($args['fields'])) {
					if (is_array($args['fields'])) {
						$this->sql .= implode(', ', $args['fields']);
					} else {
						$this->sql .= $args['fields'];
					}
				} else {
					$this->sql .= " * ";
				}
				$this->sql .= " FROM ";
				if (!isset($this->table) || empty($this->table)) {
					throw new Exception("Table not set");
				}
				$this->sql .= $this->table;

				/*Join Query*/
				if (isset($args['join']) && !empty($args['join'])) {
					$this->sql .= " ".$args['join'];
				}
				/*Join Query*/

				if (isset($args['where']) && !empty($args['where'])) {
					if (is_array($args['where'])) {
						$temp = array();
						foreach ($args['where'] as $column_name => $value) {
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}
						$this->sql .= " WHERE ".implode(' AND ', $temp);
					} else {
						$this->sql .= " WHERE ".$args['where'];
					}
				}

				/*Group*/
				if (isset($args['group_by']) && !empty($args['group_by'])) {
					$this->sql .= " GROUP BY ".$args['group_by'];
				}
				/*Group*/

				/*Order*/
				if (isset($args['order_by']) && !empty($args['order_by'])) {
					$this->sql .= " ORDER BY ".$args['order_by'];
				} else {
					$this->sql .= " ORDER BY ".$this->table.".id DESC";
				}
				/*Order*/

				/*Limit*/
				if (isset($args['limit']) && !empty($args['limit'])) {
					if (is_array($args['limit'])) {
						$this->sql .= " LIMIT ".$args['limit'][0].",".$args['limit'][1];
					} else {
						$this->sql .= " LIMIT ".$args['limit'];
					}
				}
				/*Limit*/
				$this->stmt = $this->conn->prepare($this->sql);
				if (isset($args['where']) && !empty($args['where']) && is_array($args['where'])) {
					foreach ($args['where'] as $column_name => $value) {
						if (is_int($value)) {
							$param = PDO::PARAM_INT;
						} elseif (is_bool($value)) {
							$param = PDO::PARAM_BOOL;
						} elseif (is_null($value)) {
							$param = PDO::PARAM_NULL;
						} else {
							$param = PDO::PARAM_STR;
						}
						if ($param) {
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				if ($is_die) {
					echo $this->sql;
				}
				$this->stmt->execute();
				$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
				return count($data);
				} catch (PDOException $e) {
						error_log(
							date('Y-m-d h:i:s A').", Select Query: ".$e->getMessage()."\r\n"
							, 3, ERROR_PATH.'/error.log');
						return false;
					} catch (Exception $e) {
						error_log(
							date('Y-m-d h:i:s A').", General: ".$e->getMessage()."\r\n"
							, 3, ERROR_PATH.'/error.log');
						return false;
					}
			}
}
	
	