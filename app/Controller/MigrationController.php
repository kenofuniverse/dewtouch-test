<?php
	class MigrationController extends AppController{

		public function index() {
			if(isset($this->request->data['Migrate'])) {
				ini_set('auto_detect_line_endings', true);

				$this->loadModel('Member');
				$this->loadModel('Transaction');
				$this->loadModel('TransactionItem');

				$file = $this->request->data['Migrate']['file'];
				$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
				if(in_array($file['type'], $mimes)){
					$content = array(); 
					$handle = fopen($file['tmp_name'], 'r'); 
					
					$row_index = 0;
					while(($row = fgetcsv($handle, 0, ",")) !== false) {
						if ($row_index !== 0) {
							$member_no = explode(' ', $row[3]);
							$content[] = array(
								'Member' => array(
									'type' => $member_no[0],
									'no' => $member_no[1],
									'name' => $row[2],
									'company' => $row[5],
									'valid' => 1
								),
								'Transaction' => array(
									'member_name' => $row[2],
									'member_paytype' => $row[4],
									'member_company' => $row[5],
									'date' => date('Y-m-d H:i:s', strtotime($row[0])),
									'year' => date('Y', strtotime($row[0])),
									'month' => date('m', strtotime($row[0])),
									'ref_no' => $row[1],
									'receipt_no' => $row[8],
									'payment_method' => $row[6],
									'batch_no' => $row[7],
									'cheque_no' => $row[9],
									'payment_type' => $row[10],
									'renewal_year' => $row[11],
									'subtotal' => $row[12],
									'tax' => $row[13],
									'total' => $row[14],
									'valid' => 1,
									'TransactionItem' => array(
										array(
											'description' => $row[10],
											'sum' => $row[14],
											'valid' => 1,
											'table' => 'Member',
											'table_id' => $row_index
										)
									)
								)
							);
						}
						$row_index ++;
					}
					$this->Member->saveAll($content, array('deep' => true));
					fclose($handle); 
				} else {
					$this->setFlash("Sorry, mime type not allowed");
				}
			}
		}
		
		public function q1(){
			
			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
	}