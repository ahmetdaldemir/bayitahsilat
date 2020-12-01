import { Component, OnInit } from '@angular/core';
import { MyService } from 'src/app/shared/services/myservice.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { LocalStoreService } from "src/app/shared/services/local-store.service";

@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.scss'],
})
export class HistoryComponent implements OnInit {
  
  
  invoices: any[]


  constructor(
    private store: LocalStoreService,
    private ms: MyService,
    private modalService: NgbModal,
    private toastr: ToastrService
  ) { }

  ngOnInit() {
    this.loadHistory()
}

loadHistory() {
  let id = this.store.getItem("id");
  this.ms.getHistory(id)
      .subscribe(res => {
          this.invoices = res;
      })
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
