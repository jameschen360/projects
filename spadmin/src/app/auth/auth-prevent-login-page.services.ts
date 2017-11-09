import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';

import { AuthService } from './auth.service';



@Injectable()
export class AuthPreventLoginPage implements CanActivate {

    constructor (private authService: AuthService,
                 private router: Router) {

    }
    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        if (localStorage.token != null) {
            this.router.navigate(['/dashboard']);
            return false;
        }
        return true;
    }
}
