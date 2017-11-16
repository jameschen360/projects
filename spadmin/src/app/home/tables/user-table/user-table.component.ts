import { Component, Inject, OnInit, ViewContainerRef } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef, MatDialog } from '@angular/material';
import { UserTableService } from '../../../server/user-table/user-table.service';

import { UserModalComponent } from './user-modal/user-modal.component';

declare var $;

@Component({
  selector: 'app-user-table',
  templateUrl: './user-table.component.html',
  styleUrls: ['./user-table.component.css'],
})
export class UserTableComponent implements OnInit {

  public userDetails: any;
  public responseData;
  public token: string;
  userTablePostData = {
    'user_id': '',
    'token': ''
  };
  customerID;
  userDatas;
  public loading = false;
  constructor(public getData: UserTableService, public dialog: MatDialog) {
    const data = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = data.userData;
    this.token = data.token;
    this.userTablePostData.user_id = this.userDetails.id;
    this.userTablePostData.token = this.token;
    this.getUserTable();
  }

  ngOnInit() {

  }

  getUserTable() {
    this.loading = true;
    this.getData.postData(this.userTablePostData, 'userTable').then((result) => {
      this.responseData = result;
      this.userDatas = this.responseData.userData;
      $(function () {
        $('#userTable').DataTable({
          responsive: true
        });
      });
      this.loading = false;
    }, (err) => {
    });
  }

  viewUserModal(userIDHTML) {
    this.customerID = userIDHTML.innerHTML;
    const dialogRef = this.dialog.open(UserModalComponent, {
      width: '420px',
      data: { customerID: this.customerID }
    });

    dialogRef.afterClosed().subscribe(result => {
      // do something if modal clses
    });

  }


}
