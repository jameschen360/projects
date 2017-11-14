import { Router } from '@angular/router';
import 'rxjs/add/operator/map';

import { Injectable } from '@angular/core';
import { Headers, Http } from '@angular/http';

@Injectable()
export class DeliveredTableService {
  loginAPIURI = 'https://springbankdelivery.com/portal/angularServices/delivered/';

  constructor(public http: Http,
              public router: Router) { }
  postData(credentials, type) {
    return new Promise((resolve, reject) => {
      const headers = new Headers();
      this.http.post(this.loginAPIURI + type, JSON.stringify(credentials), { headers: headers })
        .subscribe(res => {
          resolve(res.json());
        }, (err) => {
          reject(err);
        });
    });
  }

}
