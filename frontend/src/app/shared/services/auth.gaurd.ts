import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { filter } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGaurd implements CanActivate {

  constructor(
    private router: Router,
    private auth: AuthService
  ) { }

  canActivate() {
    if (this.auth.authenticated) {
      return true;
    } else {
      this.router.navigate(['/sessions/signin'], { queryParams:  filter, skipLocationChange: true});  
      //this.router.navigateByUrl('/sessions/signin');
    }
  }
}
