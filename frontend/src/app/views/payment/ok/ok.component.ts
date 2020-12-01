import { Component, OnInit } from '@angular/core';
import { MyService } from 'src/app/shared/services/myservice.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { LocalStoreService } from "src/app/shared/services/local-store.service";
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-ok',
  templateUrl: './ok.component.html',
  styleUrls: ['./ok.component.scss'],
})
export class OkComponent implements OnInit {
  
  
  invoices: any[]
  id:string;

  constructor(
    private route: ActivatedRoute,
    private store: LocalStoreService,
    private ms: MyService,
    private modalService: NgbModal,
    private toastr: ToastrService
  ) { }

  ngOnInit() {
    this.loadOk()
}

loadOk() {
  this.id = this.route.snapshot.params['id'];
  this.ms.getOk(this.id).subscribe(res => {  this.invoices = res; })
}

// deleteInvoice(id, modal) {
//   this.modalService.open(modal, { ariaLabelledBy: 'modal-basic-title', centered: true })
//       .result.then((result) => {
//           this.ms.deleteInvoice(id)
//               .subscribe(res => {
//                   this.toastr.success('Invoice Deleted!', 'Success!', { timeOut: 3000 });
//                   this.loadInvoices();
//               })
//       }, (reason) => {
//       });
// }

}
