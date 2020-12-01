import { Injectable } from "@angular/core";
import { LocalStoreService } from "./local-store.service";
import { Router } from "@angular/router";
import { of } from "rxjs";
import { delay, filter } from "rxjs/operators";
import { HttpClient } from '@angular/common/http';
import { Utils } from '../utils';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: "root"
})
export class AuthService {
  //Only for demo purpose
  authenticated = true;

  constructor(private store: LocalStoreService, private router: Router, private http: HttpClient) {
     this.checkAuth();
  }

  checkAuth() {
    this.authenticated = this.store.getItem("demo_login_status");
  }

  getuser() {
    return of({});
  }

  signin(credentials) {
    this.authenticated = true;
     return this.http.post<any[]>('https://tahsilat.sahbaz.com.tr/admin/login/seller_process', credentials, {responseType: 'json'});
      
    
  }
  signout() {
    this.authenticated = false;
    this.store.setItem("demo_login_status", false);
    this.router.navigate(['/sessions/signin'], { queryParams:  filter, skipLocationChange: true,preserveFragment: true });  
    //this.router.navigateByUrl("/sessions/signin");
  }

  profil() {
    this.router.navigateByUrl("/dashboard/profil");  
  }
  
}
