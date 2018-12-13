<?php

class FileUploadController extends AppController {
	public function index() {

		$this->set('title', __('File Upload Answer'));
		
		if(isset($this->request->data['FileUpload'])) {
			ini_set('auto_detect_line_endings', true);

			$file = $this->request->data['FileUpload']['file'];
			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
			if(in_array($file['type'], $mimes)){
				$content = array(); 
				$handle = fopen($file['tmp_name'], 'r'); 
				
				$row_index = 0;
				while(($row = fgetcsv($handle, 0, ",")) !== false) {
					if ($row_index !== 0) {
						$content[] = array(
							'name' => $row[0],
							'email' => $row[1]
						);
					}
					$row_index ++;
				}
				$this->FileUpload->saveMany($content, array('deep' => true));
				fclose($handle); 
			} else {
				$this->setFlash("Sorry, mime type not allowed");
			}
		}

		$file_uploads = $this->FileUpload->find('all');

		$this->set(compact('file_uploads'));
	}
}