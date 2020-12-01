import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Utils } from '../utils';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class MyService {

    
    constructor(
        private http: HttpClient,
    ) { }


    // getInvoices() {
    //     return this.http.get<any[]>('/api/invoices');
    // }
    // getInvoice(id) {
    //     return this.http.get<any[]>('/api/invoices/'+id);
    // }
    // saveInvoice(invoice) {
    //     if(invoice.id) {
    //         return this.http.put<any[]>('/api/invoices/'+invoice.id, invoice);
    //     } else {
    //         invoice.id = Utils.genId();
    //         return this.http.post<any[]>('/api/invoices/', invoice);
    //     }
    // }
    // deleteInvoice(id) {
    //     return this.http.delete<any[]>('/api/invoices/'+id);
    // }
    // getMails() {
    //     return this.http.get<any[]>('/api/mails');
    // }
    // getCountries() {
    //     return this.http.get<any[]>('/api/countries');
    // }
    // getProducts() {
    //     return this.http.get<any[]>('api/products');
    // }


    /*-------*/

    // payment(data) {
    //     return this.http.post<any[]>('http://tahsilat.sahbaz.com.tr/admin/payment/index', data, {responseType: 'json'});
    // }


   getHistory(id) {
        return this.http.get<any[]>('https://tahsilat.sahbaz.com.tr/admin/api/getHistory/'+id+'');
    }

    getProfil(id) {
        return this.http.get<any[]>('https://tahsilat.sahbaz.com.tr/admin/api/getProfil/'+id+'');
    }
    
    profilUpdate(data) {
        return this.http.post('https://tahsilat.sahbaz.com.tr/admin/api/updateSeller', data, {responseType: 'json'});
    }
    
    getOk(id) {
        return this.http.get<any[]>('https://tahsilat.sahbaz.com.tr/admin/api/getPaymentDetail/'+id+'');
    }

    getFail(id) {
        return this.http.get<any[]>('https://tahsilat.sahbaz.com.tr/admin/api/getPaymentDetail/'+id+'');
    }

    getBin(number) {
        return this.http.get<any[]>('https://tahsilat.sahbaz.com.tr/admin/api/getBin/'+number+'');
    }
    
}
