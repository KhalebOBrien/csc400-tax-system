<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Tax Filing') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('filing.personal.store') }}">
                @csrf
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">{{ __('Section 1') }}</x-slot>
                        <x-slot name="description">{{ __('Personal Information') }}</x-slot>
                    </x-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="{{ __('Full Name') }}" required />
                                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="Auth::user()->last_name.', '.Auth::user()->other_name" disabled autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <!-- TIN -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="tin" value="{{ __('Tax Identification Number') }}" required />
                                    <x-input id="tin" name="tin" type="text" class="mt-1 block w-full" :value="Auth::user()->tin" disabled autocomplete="tin" />
                                    <x-input-error for="tin" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <x-section-title>
                            <x-slot name="title">{{ __('Section 2') }}</x-slot>
                            <x-slot name="description">{{ __('Income Data') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <!-- Basic Monthly Salary -->
                                    <div>
                                        <x-label for="basic_salary" value="{{ __('Basic Monthly Salary (N)') }}" required />
                                        <x-input id="basic_salary" name="basic_salary" type="number" class="mt-1 block w-full" required :value="old('basic_salary')" />
                                        <x-input-error for="basic_salary" class="mt-2" />
                                    </div>
                                    <!-- Monthly Housing Allowance -->
                                    <div>
                                        <x-label for="housing_allowance" value="{{ __('Monthly Housing Allowance (N)') }}" required />
                                        <x-input id="housing_allowance" name="housing_allowance" type="number" class="mt-1 block w-full" required :value="old('housing_allowance')" />
                                        <x-input-error for="housing_allowance" class="mt-2" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <!-- Monthly Transportation Allowance -->
                                    <div>
                                        <x-label for="transport_allowance" value="{{ __('Monthly Transportation Allowance (N)') }}" required />
                                        <x-input id="transport_allowance" name="transport_allowance" type="number" class="mt-1 block w-full" required :value="old('transport_allowance')" />
                                        <x-input-error for="transport_allowance" class="mt-2" />
                                    </div>
                                    <!-- Monthly Miscellaneous Allowance -->
                                    <div>
                                        <x-label for="misc_allowance" value="{{ __('Monthly Miscellaneous Allowance (N)') }}" required />
                                        <x-input id="misc_allowance" name="misc_allowance" type="number" class="mt-1 block w-full" required :value="old('misc_allowance')" />
                                        <x-input-error for="misc_allowance" class="mt-2" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-6 gap-6">
                                    <!--  -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="payment_type" value="{{ __('Tax Payment Type') }}" required />
                                        <select name="payment_type" id="payment_type" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="yearly">Yearly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                        <x-input-error for="payment_type" class="mt-2" />
                                    </div>
                                </div>

                                <div class="text-md font-bold mb-4 mt-4">
                                    <p class="mb-3">{{ __('Gross Annual Income:') }} <span id="g_a_i" class="text-lg">0</span></p>
                                    <p class="mb-3">{{ __('Total Exemptions:') }} <span id="t_e" class="text-lg">0</span></p>
                                    <p class="mb-3">{{ __('Chargeable Income:') }} <span id="c_i" class="text-lg">0</span></p>
                                    <p class="mb-3">{{ __('Annual Payable Tax:') }} <span id="a_p_t" class="text-lg">0</span></p>
                                    <p>{{ __('Monthly Payable Tax:') }} <span id="m_p_t" class="text-lg">0</span></p>

                                    <input type="hidden" name="monthly_amount" id="monthly_amount">
                                    <input type="hidden" name="yearly_amount" id="yearly_amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <x-section-title>
                            <x-slot name="title">{{ __('Section 3') }}</x-slot>
                            <x-slot name="description">{{ __('Acknowledgement') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="text-gray-600 text-sm mt-6 mb-4">
                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="flex items-center">
                                            <x-checkbox name="toc" value="Equipment" required />
                                            <div class="ms-2">
                                                I, <span class="font-bold">{{Auth::user()->last_name.', '.Auth::user()->other_name}}</span> hereby certify that the information provided is accurate and true. I understand that my filing will be reviewed and additional information may be requested.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-600 mb-4 mt-4 italic">
                                    {{ __('NOTE: You will be redirected to the payment page after you click proceed.') }}
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                <x-button wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Proceed') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let basic_salary = document.getElementById('basic_salary');
    let housing_allowance = document.getElementById('housing_allowance');
    let transport_allowance = document.getElementById('transport_allowance');
    let misc_allowance = document.getElementById('misc_allowance');
    let g_a_i = document.getElementById('g_a_i');
    let t_e = document.getElementById('t_e');
    let c_i = document.getElementById('c_i');
    let a_p_t = document.getElementById('a_p_t');
    let m_p_t = document.getElementById('m_p_t');
    let monthly_amount = document.getElementById('monthly_amount');
    let yearly_amount = document.getElementById('yearly_amount');

    const computeTax = (basicSalary, housing, transport, misc) => {
        // Step 1: Calculate consolidated salary (gross emolument per annum)
        const grossMonthly = basicSalary + housing + transport + misc;
        const grossAnnual = grossMonthly * 12;

        // Step 2: Compute Consolidated Relief Allowance (CRA)
        const craFixed = 200_000; // N200,000
        const craPercent = 0.20 * grossAnnual; // 20% of gross
        const cra = craFixed + Math.max(craFixed, craPercent);

        // Step 3: Compute tax-exempt items
        const nhf = 2.5, nhis = 5, pension = 8;
        const nhfContribution = (nhf / 100) * grossMonthly * 12; // National Housing Fund (NHF) is % of monthly income
        const nhisContribution = (nhis / 100) * grossMonthly * 12; // National Health Insurance Scheme (NHIS) is % of monthly income
        const pensionContribution = (pension / 100) * (basicSalary + housing + transport) * 12; // Pension based on Basic, Housing, Transport

        const totalExemptions = nhfContribution + nhisContribution + pensionContribution;

        // Step 4: Compute chargeable income
        const chargeableIncome = grossAnnual - cra - totalExemptions;

        // Step 5: Apply tax bands
        const taxBands = [
            { limit: 300_000, rate: 0.07 }, // 7%
            { limit: 300_000, rate: 0.11 }, // 11%
            { limit: 500_000, rate: 0.15 }, // 15%
            { limit: 500_000, rate: 0.19 }, // 19%
            { limit: 1_600_000, rate: 0.21 }, // 21%
            { limit: Infinity, rate: 0.24 }  // 24% for income above 3.2M
        ];

        let remainingIncome = chargeableIncome;
        let annualTax = 0;

        for (const band of taxBands) {
            if (remainingIncome <= 0) break;
            const taxableAmount = Math.min(remainingIncome, band.limit);
            annualTax += taxableAmount * band.rate;
            remainingIncome -= taxableAmount;
        }

        // Step 6: Minimum tax determination
        const minimumTax = 0.01 * grossAnnual; // 1% of gross annual
        if (chargeableIncome < minimumTax) {
            annualTax = minimumTax;
        }

        // Step 7: Calculate monthly tax
        const monthlyTax = annualTax / 12;

        // Return results
        return {
            grossAnnual: parseFloat(grossAnnual.toFixed(2)),
            cra: parseFloat(cra.toFixed(2)),
            totalExemptions: parseFloat(totalExemptions.toFixed(2)),
            chargeableIncome: parseFloat(chargeableIncome.toFixed(2)),
            annualTax: parseFloat(annualTax.toFixed(2)),
            monthlyTax: parseFloat(monthlyTax.toFixed(2)),
        };
    }

    let getValue = () => {
        let basic = parseFloat(basic_salary.value) || 0;
        let housing = parseFloat(housing_allowance.value) || 0;
        let transport = parseFloat(transport_allowance.value) || 0;
        let misc = parseFloat(misc_allowance.value) || 0;
        console.log(basic, housing, transport, misc);

        return {
            basic,
            housing,
            transport,
            misc
        }
    }

    let setValue = (computePayableTax) => {
        let {
            grossAnnual,
            cra,
            totalExemptions,
            chargeableIncome,
            annualTax,
            monthlyTax
        } = computePayableTax

        g_a_i.textContent = grossAnnual
        t_e.textContent = totalExemptions,
        c_i.textContent = chargeableIncome,
        a_p_t.textContent = annualTax,
        m_p_t.textContent = monthlyTax

        yearly_amount.value = annualTax
        monthly_amount.value = monthlyTax
    }


    basic_salary.oninput = function() {
        let { basic, housing, transport, misc } = getValue();
        let computePayableTax = computeTax(basic, housing, transport, misc)
        console.log(computePayableTax);
        setValue(computePayableTax)
    };

    housing_allowance.oninput = function() {
        let { basic, housing, transport, misc } = getValue();
        let computePayableTax = computeTax(basic, housing, transport, misc)
        console.log(computePayableTax);
        setValue(computePayableTax)
    };

    transport_allowance.oninput = function() {
        let { basic, housing, transport, misc } = getValue();
        let computePayableTax = computeTax(basic, housing, transport, misc)
        console.log(computePayableTax);
        setValue(computePayableTax)
    };

    misc_allowance.oninput = function() {
        let { basic, housing, transport, misc } = getValue();
        let computePayableTax = computeTax(basic, housing, transport, misc)
        console.log(computePayableTax);
        setValue(computePayableTax)
    };

</script>

