import { PaymentModule } from './payment.module';

describe('InboxModule', () => {
  let inboxModule: PaymentModule;

  beforeEach(() => {
    inboxModule = new PaymentModule();
  });

  it('should create an instance', () => {
    expect(PaymentModule).toBeTruthy();
  });
});
