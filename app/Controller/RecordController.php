<?php
	class RecordController extends AppController{
		
		public function index(){
			// ini_set('memory_limit','256M');
			// set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			$this->set('title',__('List Record'));
		}

		public function query(){
			$offset = 0;
			$limit = 10;
			$sort_by = 'id';
			$order = 'ASC';
			$search = '';
			$aColumns = array('id', 'name');
			
			if(isset($this->request->query['iDisplayStart'])) {
				$offset = intval($this->request->query['iDisplayStart']);
			}

			if(isset($this->request->query['iDisplayLength'])) {
				$limit = intval($this->request->query['iDisplayLength']);
			}

			if(isset($this->request->query['iSortCol_0'])) {
				for ( $i = 0; $i < intval($this->request->query['iSortingCols']); $i ++ ){
					if ( $this->request->query[ 'bSortable_'.intval($this->request->query['iSortCol_'.$i]) ] == "true" ) {
						$sort_by = $aColumns[intval($this->request->query['iSortCol_' . $i])];
						$order = $this->request->query['sSortDir_' . $i];
					}
				}
			}

			if (isset($this->request->query['sSearch'])) {
				$search = $this->request->query['sSearch'];
			}

			$args = array(
				'order' => array($sort_by . ' ' . $order),
				'limit' => $limit,
				'offset' => $offset
			);

			if ($search !== '') {
				$args['conditions'] = array(
					'name LIKE' => '%' . $search . '%'
				);
			}

			$records = $this->Record->find('all', $args);
			
			$data = array();
			foreach($records as $data_item) {
				$data[] = array(
					$data_item['Record']['id'],
					$data_item['Record']['name']
				);
			}
			$total_count = $this->Record->find('count');
			$filtered_count = $this->Record->find('count', array(
				'conditions' => array(
					'name LIKE' => '%' . $search . '%'
				)
			));

			$results = [
				"sEcho" => (isset($this->request->query['sEcho'])) ? $this->request->query['sEcho'] : 1,
        		"iTotalRecords" => $total_count,
        		"iTotalDisplayRecords" => $filtered_count,
        		"aaData" => $data
			];			

			$this->response->header(array(
				'Content-type: application/json'
			));
			echo json_encode($results);
			exit;
		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}