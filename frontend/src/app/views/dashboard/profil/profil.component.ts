import { Component, OnInit } from '@angular/core';
import { SharedAnimations } from 'src/app/shared/animations/shared-animations';
import { LocalStoreService } from "src/app/shared/services/local-store.service";
import { MyService } from 'src/app/shared/services/myservice.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.scss'],
  animations: [SharedAnimations]
})
export class ProfilComponent implements OnInit {
  viewMode: 'edit' | 'print' = 'edit';
  profilForm: FormGroup;
  loading: boolean;
  loadingText: string;
  profil: any = {};
 


  constructor(    
    private fb: FormBuilder,
    private store: LocalStoreService,
    private ms: MyService,
    private toastr: ToastrService

    ) {}

  ngOnInit() {
         this.viewMode = 'edit';
         let id = this.store.getItem("id");
         this.ms.getProfil(id).subscribe(res => {  
          this.profilForm = this.fb.group({
            id: [res[0].id,Validators.required],
            firstname: [res[0].firstname,Validators.required],
            lastname: [res[0].lastname,Validators.required],
            email: [res[0].email,Validators.required],
            password: ['',Validators.required],
            passwordold: [res[0].password,Validators.required],
            company: [res[0].company,Validators.required],
            address: [res[0].address,Validators.required],
            taxNumber: [res[0].taxNumber,Validators.required],
            taxOffice: [res[0].taxOffice,Validators.required],
          });
         })


  }

 
  
  profilUpdate() {
    this.loading = true;
    this.loadingText = 'Bekleyiniz...';
    this.ms.profilUpdate(this.profilForm.value)
        .subscribe(res => {
          this.loading = false;
          this.toastr.success('Bilgileriniz Güncellendi!', 'Başarılı!', { timeOut: 3000 });
        });
   }
 


}
