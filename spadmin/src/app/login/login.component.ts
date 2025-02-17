import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import {FormControl, FormGroupDirective, NgForm, Validators} from '@angular/forms';
import {ErrorStateMatcher} from '@angular/material/core';

import { LoginService } from '../server/login.service';

declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  responseData: any;
  returnUrl: string;
  loginData = {
    'username': '',
    'password': ''
  };

  errorLoginMsg = false;

  authenticated = false;

  public loading = false;

  constructor(public authService: LoginService,
    public router: Router,
    public route: ActivatedRoute) {
      this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || 'dashboard';
    }

  ngOnInit() {
  }

  onSignin(form: NgForm) {
    this.loading = true;
    this.loginData.username = form.value.username;
    this.loginData.password = form.value.password;

    if (this.loginData.username && this.loginData.password) {
      this.authService.postData(this.loginData, 'login').then((result) => {
        this.responseData = result;
        if (this.responseData.userData === false) {
          this.loading = false;
          this.errorLoginMsg = true;
        } else {
          this.loading = false;
          this.errorLoginMsg = false;
          this.router.navigateByUrl(this.returnUrl);
        }
      }, (err) => {
      });
    } else {
      // error message
    }
  }

  loaderAnimate() {
    $('#signInButton').html('<span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span> Authenticating...');
  }
}


