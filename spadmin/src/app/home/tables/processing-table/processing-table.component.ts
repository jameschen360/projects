import { Component, OnInit, Inject } from '@angular/core';

import { ProcessingTableService } from '../../../server/processing-table/processing-table.service';

import { ProcessingModalComponent } from './processing-modal/processing-modal.component';

import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

declare var $: any;

@Component({
  selector: 'app-processing-table',
  templateUrl: './processing-table.component.html',
  styleUrls: ['./processing-table.component.css'],
})
export class ProcessingTableComponent implements OnInit {

  public userDetails: any;
  public responseData;
  public token: string;
  processingTablePostData = {
    'id': '',
    'token': ''
  };
  processingOrderBusy: Promise<any>;
  order;

  constructor(public getData: ProcessingTableService, public dialog: MatDialog) {
    const data = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = data.userData;
    this.token = data.token;
    this.processingTablePostData.id = this.userDetails.id;
    this.processingTablePostData.token = this.token;
    this.getProcessingTable();
  }

  ngOnInit() {

  }

  getProcessingTable() {
    this.processingOrderBusy = this.getData.postData(this.processingTablePostData, 'processingTable').then((result) => {
      this.responseData = result;
      $(function () {
        $('#processingTable').DataTable({
          responsive: true
        });
      });
    }, (err) => {
    });
  }

  viewProcessingModal(orderIDHTML) {
    this.order = orderIDHTML.innerHTML;
    const dialogRef = this.dialog.open(ProcessingModalComponent, {
      width: '100%',
      data: { orderID: this.order }
    });

    dialogRef.afterClosed().subscribe(result => {
      // do something if modal clses
    });


  }
}

