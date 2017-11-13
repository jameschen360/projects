import { Component, OnInit, ViewEncapsulation } from '@angular/core';

import { MaintenanceTableService } from '../../../server/mait-table/mait-table.service';

//import { MaitModalComponent } from './mait-modal/mait-modal.component';

import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

@Component({
  selector: 'app-mait-table',
  templateUrl: './mait-table.component.html',
  styleUrls: ['./mait-table.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class MaitTableComponent implements OnInit {

  // public userDetails: any;
  // public responseData;
  // public token: string;
  // processingTablePostData = {
  //   'id': '',
  //   'token': ''
  // };
  // processingOrderBusy: Promise<any>;
  // order;


  // public getData: ProcessingTableService, public dialog: MatDialog
  constructor() {
    // const data = JSON.parse(localStorage.getItem('userData'));
    // this.userDetails = data.userData;
    // this.token = data.token;
    // this.processingTablePostData.id = this.userDetails.id;
    // this.processingTablePostData.token = this.token;
    // this.getProcessingTable();
  }

  
  ngOnInit() {
  }

}
