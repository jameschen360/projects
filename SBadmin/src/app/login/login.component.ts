import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';

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
  loginData = {
    'username': '',
    'password': ''
  };

  errorLoginMsg = false;

  constructor(private authService: AuthService,
              private router: Router) { }

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
          $('#signInButton').html('Sign In');
        } else {
          // user is signed in
          this.router.navigate(['/dashboard']);
          this.errorLoginMsg = false;
          localStorage.setItem('userData', JSON.stringify(this.responseData));
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
