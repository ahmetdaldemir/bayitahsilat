import { Component, OnInit } from '@angular/core';
import { SharedAnimations } from 'src/app/shared/animations/shared-animations';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../../../shared/services/auth.service';
import { Router, RouteConfigLoadStart, ResolveStart, RouteConfigLoadEnd, ResolveEnd } from '@angular/router';
import { LocalStoreService } from "src/app/shared/services/local-store.service";

@Component({
    selector: 'app-signin',
    templateUrl: './signin.component.html',
    styleUrls: ['./signin.component.scss'],
    animations: [SharedAnimations]
})
export class SigninComponent implements OnInit {
    loading: boolean;
    loadingText: string;
    signinForm: FormGroup;
    isLoggedIn:boolean;

    constructor(
        private fb: FormBuilder,
        private auth: AuthService,
        private router: Router,
        private store: LocalStoreService,
    ) { }

    ngOnInit() {
        this.router.events.subscribe(event => {
            if (event instanceof RouteConfigLoadStart || event instanceof ResolveStart) {
                this.loadingText = 'Bekleyiniz ...';

                this.loading = true;
            }
            if (event instanceof RouteConfigLoadEnd || event instanceof ResolveEnd) {
                this.loading = false;
            }
        });

        this.signinForm = this.fb.group({
            email: ['', Validators.required],
            password: ['', Validators.required]
        });
    }

    signin() {
        this.loading = true;
        this.loadingText = 'Bekleyiniz...';
        this.auth.signin(this.signinForm.value)
            .subscribe(res => {
                if(res["isLoggedIn"] == true)
                {
                    this.store.setItem("demo_login_status", true);
                    this.store.setItem("firstname", res["firstname"]);
                    this.store.setItem("lastname", res["lastname"]);
                    this.store.setItem("email", res["email"]);
                    this.store.setItem("id", res["id"]);
                    this.router.navigateByUrl('/dashboard/v1');
                    this.loading = false;
                }else{
                    console.log("Burada");
                   // this.router.navigateByUrl('/session/signin');
                    this.loading = false;
                }
                
            });
    }

}
