import { Component, OnInit, Inject } from '@angular/core';

import { DeliveredTableService } from '../../../server/delivered-table/delivered-table.service';

import { DeliveredModalComponent } from './delivered-modal/delivered-modal.component';

import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

declare var $: any;

@Component({
  selector: 'app-delivered-table',
  templateUrl: './delivered-table.component.html',
  styleUrls: ['./delivered-table.component.css'],
})
export class DeliveredTableComponent implements OnInit {

  public userDetails: any;
  public responseData;
  public deliveredResult;
  public token: string;
  deliveredTablePostData = {
    'user_id': '',
    'token': ''
  };
  order;

  public loading = false;

  constructor(public getData: DeliveredTableService, public dialog: MatDialog) {
    const data = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = data.userData;
    this.token = data.token;
    this.deliveredTablePostData.user_id = this.userDetails.id;
    this.deliveredTablePostData.token = this.token;
    this.getDeliveredTable();
  }

  ngOnInit() {

  }

  getDeliveredTable() {
    this.loading = true;
    this.getData.postData(this.deliveredTablePostData, 'deliveredTable').then((result) => {
      this.responseData = result;
      this.deliveredResult = this.responseData.deliveredOrderData;
      $(function () {
        $('#deliveredTable').DataTable({
          responsive: true
        });
      });
      this.loading = false;
    }, (err) => {
    });
  }

  viewDeliveredModal(orderIDHTML) {
    this.order = orderIDHTML.innerHTML;
    const dialogRef = this.dialog.open(DeliveredModalComponent, {
      width: '100%',
      data: { orderID: this.order }
    });

    dialogRef.afterClosed().subscribe(result => {
      // do something if modal clses
    });


  }
}


