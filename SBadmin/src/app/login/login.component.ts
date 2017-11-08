import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';

import { AuthService } from '../auth/auth.service';

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

  constructor(private authService: AuthService,
    private router: Router,
    private route: ActivatedRoute) { }

  ngOnInit() {

  }

  onSignin(form: NgForm) {
    this.loginData.username = form.value.username;
    this.loginData.password = form.value.password;

    if (this.loginData.username && this.loginData.password) {
      this.authService.postData(this.loginData, 'login').then((result) => {
        this.responseData = result;
        if (this.responseData.userData === false) {
          this.errorLoginMsg = true;
        } else {
          this.errorLoginMsg = false;
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


