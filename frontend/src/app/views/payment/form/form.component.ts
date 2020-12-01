import {Component, OnInit} from '@angular/core';
import {SharedAnimations} from 'src/app/shared/animations/shared-animations';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {FormGroup, FormBuilder, FormControl} from '@angular/forms';
import {ToastrService} from 'ngx-toastr';
import {MyService} from 'src/app/shared/services/myservice.service';
import {HttpClient} from '@angular/common/http';
import { Interval } from 'date-fns';
import { LocalStoreService } from "src/app/shared/services/local-store.service";


@Component({
    selector: 'app-form',
    templateUrl: './form.component.html',
    styleUrls: ['./form.component.scss'],
    animations: [SharedAnimations]
})
export class FormComponent implements OnInit {
    url:"https://vpos.qnbfinansbank.com/Gateway/Default.aspx";
    loading: boolean;
    userForm: FormGroup;
    viewMode: 'list' | 'grid' = 'list';
    allSelected: boolean;
    page = 1;
    pageSize = 8;
    Users: any['push'] = [];
    id_seller: Interval;
    cardNumber = '';
    cardName = '';
    cardCcv = '';
    cardDateMounth = '';
    cardDateYear = '';

    myStylesVisa='';
    myStylesMaster='';
    myStylesAmex='';
    bankName :any[];
    bin : any['push'] = [];
    constructor(
        private store: LocalStoreService,
        private fb: FormBuilder,
        private toastr: ToastrService,
        private modalService: NgbModal,
        private ms: MyService,
    ) {
    }



    ngOnInit(): void {
        this.id_seller = this.store.getItem("id");
        // this.createForm();
    }

    onKeyUpNumber(x) {
        this.cardNumber =x.target.value;
     
        let character = x.target.value.substr(0,1);
        if(character == 4)
        {
            this.myStylesVisa = 'display:block';
            this.myStylesMaster = "display:none";
            this.myStylesAmex = "display:none";
        }else if(character == 5)
        {
            this.myStylesVisa = 'display:none';
            this.myStylesMaster = "display:block";
            this.myStylesAmex = "display:none";

        }else if(character == 3)
        {
            this.myStylesAmex = "display:block";
            this.myStylesVisa = 'display:none';
            this.myStylesMaster = "display:none";
        }
      } 


      onKeyDown(x)
      {
        this.bin = x.target.value.substr(0,8);
        console.log(this.bin);
        this.ms.getBin(this.bin).subscribe((res) => { this.bankName = res; });
      }
   

      onKeyUpCcv(x) {
        this.cardCcv =x.target.value;
      } 
      onKeyUpName(x) {
        this.cardName =x.target.value;
      } 

      onKeyUpDateMounth(x) {
        this.cardDateMounth =x.target.value;
      } 
      onKeyUpDateYear(x) {
        this.cardDateYear =x.target.value;
      } 
    // private createForm() {
    //     this.userForm = new FormGroup({
    //         price: new FormControl(''),
    //         id_seller: new FormControl(''),
    //         installment: new FormControl(''),
    //         name: new FormControl(''),
    //         card_number: new FormControl(''),
    //         mounth: new FormControl(''),
    //         year: new FormControl(''),
    //         ccv: new FormControl(''),
    //     });
    // }


    // submit() {
    //     this.loading = true;
    //     this.userService.payment(this.userForm.value)
    //         .subscribe(
    //             (res) => {
    //                 setTimeout(() => {
    //                     this.loading = false;
    //                     this.toastr.success('Kullanıcı Eklendi.', 'Başarılı!', {progressBar: true});
    //                     this.modalService.dismissAll();
    //                  }, 3000);
    //                  console.log(res);
    //             },
    //             (error: HttpErrorResponse) => {
    //                 this.toastr.warning('HATA', 'Warning!', {progressBar: true});
    //             }
    //         );
    // }
 

}
