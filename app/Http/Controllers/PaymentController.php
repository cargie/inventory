<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;
    private $orderRepository;

    public function __construct(PaymentRepository $paymentRepo, OrderRepository $orderRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(PaymentDataTable $paymentDataTable)
    {
        // $this->paymentRepository->pushCriteria(new RequestCriteria($request));
        // $payments = $this->paymentRepository->all();

        // return view('payments.index')
        //     ->with('payments', $payments);
        
        return $paymentDataTable->render('payments.index');
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        $orders = $this->orderRepository->getAllUnPaid();
        return view('payments.create', compact('orders'));
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->findByUid($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }
        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->with(['order'])->findByUid($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->findByUid($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->findByUid($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->deleteByUid($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }
}
