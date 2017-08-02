<?php

namespace Drupal\recharge\Form;

use Drupal;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RechargeForm extends FormBase
{
    const MIN_AMOUNT = 500;
    const MAX_AMOUNT = 50000;

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'recharge_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['status_messages'] = [
            '#type' => 'status_messages'
        ];
        $form['amount'] = [
            '#type' => 'number',
            '#title' => 'Amount',
            '#description' => 'Please enter your amount between $500 and $50.000.',
            '#ajax' => [
                'callback' => [$this, 'validateAmountAjax'],
                'effect' => 'fade',
                'event' => 'keyup',
                'progress' => [
                    'type' => 'throbber',
                    'message' => 'Verifying amount...'
                ]
            ],
            '#required' => TRUE,
            '#suffix' => '<span class="amount-valid-message"></span>'
        ];
        $form['msisdn'] = [
            '#type' => 'number',
            '#title' => 'Phone Number',
            '#description' => 'Please enter your phone number.',
            '#ajax' => [
                'callback' => [$this, 'validateNumberAjax'],
                'effect' => 'fade',
                'event' => 'keyup',
                'progress' => [
                    'type' => 'throbber',
                    'message' => 'Verifying phone number...'
                ]
            ],
            '#required' => TRUE,
            '#suffix' => '<span class="number-valid-message"></span>'
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Accept',
            '#ajax' => [
                'callback' => [$this, 'submitForm'],
                'effect' => 'fade',
                'event' => 'click',
                'progress' => [
                    'type' => 'throbber',
                    'message' => 'Recharging...'
                ]
            ]
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if (!$this->verifiedIsValidAmount($form_state->getValue('amount'))) {
            $form_state->setErrorByName('amount', 'The Amount must be between $500 and $5.000.');
        }
        if (!$this->verifiedIsValidNumber($form_state->getValue('msisdn'))) {
            $form_state->setErrorByName('msisdn', 'The phone number is incorrect.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $response = new AjaxResponse();
        if ($form_state->getErrors()) {
            return $response->addCommand(
                new HtmlCommand('#recharge-form', $form)
            );
        }

        Drupal::service('recharge.rechargenumberusecase')->execute(
            $form_state->getValue('amount'),
            $form_state->getValue('msisdn')
        );

        return $response->addCommand(
            new HtmlCommand('#recharge-form', 'Recharged')
        );
    }

    /**
     * Ajax callback to validate the amount field.
     *
     * @param array $form
     * @param FormStateInterface $form_state
     *
     * @return AjaxResponse()
     */
    public function validateAmountAjax(array &$form, FormStateInterface $form_state)
    {
        $message = 'Amount is valid.';
        if (!$this->verifiedIsValidAmount($form_state->getValue('amount'))) {
            $message = 'The Amount must be between $500 and $5.000.';
        }

        return (new AjaxResponse())->addCommand(
            new HtmlCommand('.amount-valid-message', $message)
        );
    }

    /**
     * Validate the amount between 500 and 50000.
     *
     * @param $amount
     * @return true|false
     */
    private function verifiedIsValidAmount($amount)
    {
        if ($amount < self::MIN_AMOUNT || $amount > self::MAX_AMOUNT) {
            return false;
        }

        return true;
    }

    /**
     * Ajax callback to validate the msisn field.
     *
     * @param array $form
     * @param FormStateInterface $form_state
     *
     * @return AjaxResponse()
     */
    public function validateNumberAjax(array &$form, FormStateInterface $form_state) {
        $message = 'Phone number is valid.';
        if (!$this->verifiedIsValidNumber($form_state->getValue('msisdn'))) {
            $message = 'Phone number is incorrect.';
        }

        return (new AjaxResponse())->addCommand(
            new HtmlCommand('.number-valid-message', $message)
        );
    }

    /**
     * Validate the phone number is valid.
     *
     * @param $number
     * @return true|false
     */
    private function verifiedIsValidNumber($number)
    {
        $existsNumber = Drupal::service('recharge.FindANumberUseCase')->execute($number);
        if (empty($existsNumber)) {
            return false;
        }

        return true;
    }
}