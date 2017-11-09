import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ContentService } from '../../../getData/content.service';


@Component({
  selector: 'app-processing-table',
  templateUrl: './processing-table.component.html',
  styleUrls: ['./processing-table.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ProcessingTableComponent implements OnInit {
  public userDetails: any;
  public responseData: any;
  public token: string;
  processingTablePostData = {
    'id': '',
    'token': ''
  };

  constructor(public getData: ContentService) {
    const data = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = data.userData;
    this.token = data.token;
    this.processingTablePostData.id = this.userDetails.id;
    this.processingTablePostData.token = this.token;
    this.getProcessingTable();
  }

  ngOnInit() {
  }

  getProcessingTable () {
    this.getData.postData(this.processingTablePostData, 'processingTable').then((result) => {
      this.responseData = result;
    }, (err) => {
    });
  }

}
