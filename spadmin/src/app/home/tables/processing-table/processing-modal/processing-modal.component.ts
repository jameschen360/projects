import { Component, OnInit, Inject } from '@angular/core';

import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

import { ProcessingModalService } from '../../../../server/processing-table/processing-modal.service';

@Component({
  selector: 'app-processing-modal',
  templateUrl: './processing-modal.component.html',
  styleUrls: ['./processing-modal.component.css']
})
export class ProcessingModalComponent implements OnInit {
  public responseData: any;
  public userDetails: any;
  public token: string;
  processingModalBusy: Promise<any>;

  processingModalPostData = {
    'id': '',
    'processing_order_id': '',
    'token': ''
  };

  constructor(public dialogRef: MatDialogRef<ProcessingModalComponent>, @Inject(MAT_DIALOG_DATA) public data: any,
    public getData: ProcessingModalService) {

    const userData = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = userData.userData;
    this.token = userData.token;
    this.processingModalPostData.id = this.userDetails.id;
    this.processingModalPostData.token = this.token;
    this.processingModalPostData.processing_order_id = this.data.orderID;
    this.getProcessingTable();
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit() {
  }

  getProcessingTable() {
    this.processingModalBusy = this.getData.postData(this.processingModalPostData, 'processingModal').then((result) => {
      this.responseData = result;
      console.log(this.responseData);




    }, (err) => {
      // do something if error
    });
  }


}
