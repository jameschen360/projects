import { Router } from '@angular/router';
import 'rxjs/add/operator/map';

import { Injectable } from '@angular/core';
import { Headers, Http } from '@angular/http';

declare var jquery: any;
declare var $: any;

@Injectable()
export class AuthService {
  token: string;
  responseData;
  errorLoginMsg = false;
  loginAPIURI = 'http://test.healthsupplementsplus.com/';

  constructor(public http: Http,
              public router: Router) { }
  postData(credentials, type) {
    return new Promise((resolve, reject) => {
      const headers = new Headers();
      this.http.post(this.loginAPIURI + type, JSON.stringify(credentials), { headers: headers })
        .subscribe(res => {
          resolve(res.json());
          this.responseData = res.json();
          this.token = res.json().token;
          localStorage.clear();
          if (this.token != null) {
            this.errorLoginMsg = false;
            this.router.navigate(['/dashboard']);
            localStorage.setItem('userData', JSON.stringify(res.json()));
            localStorage.setItem('token', this.token);
          } else {
            this.errorLoginMsg = true;
            $('#signInButton').html('Sign In');
          }
          return this.token;
        }, (err) => {
          reject(err);
        });
    });
  }

}
