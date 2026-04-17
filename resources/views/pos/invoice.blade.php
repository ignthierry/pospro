<x-app-layout>
    <div class="px-6 pt-4 pb-12 flex flex-col items-center">
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-secondary-container text-secondary rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-4xl">check_circle</span>
        </div>
        <h2 class="font-manrope text-2xl font-bold text-on-surface mb-1">Transaction Successful</h2>
        <p class="text-on-surface-variant font-medium mb-8">Invoice #{{ $transaction->invoice_number }}</p>

        <!-- Receipt Card -->
        <div class="w-full bg-surface-container-lowest rounded-[2rem] p-6 shadow-sm mb-6 relative overflow-hidden">
            <!-- Jagged Edge simulation -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-surface-container-highest opacity-10"></div>
            
            <div class="text-center mb-6">
                <h3 class="font-manrope font-bold text-lg text-on-surface">THE ATELIER</h3>
                <p class="text-xs text-on-surface-variant font-medium">Architectural Point of Sale</p>
                <p class="text-[10px] text-on-surface-variant mt-1">{{ $transaction->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="space-y-4 mb-6">
                @foreach($transaction->details as $detail)
                <div class="flex justify-between items-start">
                    <div class="flex-grow">
                        <p class="font-manrope font-bold text-sm text-on-surface leading-tight">{{ $detail->product->name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}</p>
                    </div>
                    <span class="font-manrope font-bold text-sm text-on-surface">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <div class="border-t border-dashed border-outline-variant/30 pt-4 space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-manrope font-bold text-on-surface-variant">Total</span>
                    <span class="text-xl font-manrope font-extrabold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-manrope font-bold text-on-surface-variant">Paid</span>
                    <span class="text-sm font-manrope font-bold text-on-surface">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-manrope font-bold text-on-surface-variant">Change</span>
                    <span class="text-sm font-manrope font-bold text-secondary">Rp {{ number_format($transaction->paid_amount - $transaction->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">Thank you for your business</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="w-full space-y-3">
            @php
                $waPhone = ($transaction->customer && $transaction->customer->phone != '0') ? $transaction->customer->phone : '';
                $message = "Halo " . ($transaction->customer ? $transaction->customer->name : 'Pelanggan') . ",\n\n";
                $message .= "Terima kasih telah berbelanja di The Atelier.\n";
                $message .= "Invoice: #" . $transaction->invoice_number . "\n";
                $message .= "Tanggal: " . $transaction->created_at->format('d/m/Y H:i') . "\n\n";
                $message .= "Rincian Belanja:\n";
                foreach($transaction->details as $detail) {
                    $message .= "- " . $detail->product->name . " (" . $detail->quantity . "x) : Rp " . number_format($detail->price * $detail->quantity, 0, ',', '.') . "\n";
                }
                $message .= "\nTotal: Rp " . number_format($transaction->total_amount, 0, ',', '.') . "\n";
                $message .= "Bayar: Rp " . number_format($transaction->paid_amount, 0, ',', '.') . "\n";
                $message .= "Kembali: Rp " . number_format($transaction->paid_amount - $transaction->total_amount, 0, ',', '.') . "\n\n";
                $message .= "Terima kasih!";
                
                $waUrl = "https://wa.me/" . $waPhone . "?text=" . urlencode($message);
            @endphp

            <a href="{{ $waUrl }}" target="_blank" class="w-full h-14 bg-secondary text-on-primary rounded-full font-manrope font-bold flex items-center justify-center gap-3 shadow-md active:scale-95 transition-transform">
                <span class="material-symbols-outlined">send</span>
                Send to WhatsApp
            </a>
            
            <a href="{{ route('pos.index') }}" class="w-full h-14 bg-surface-container-highest text-primary rounded-full font-manrope font-bold flex items-center justify-center shadow-sm active:scale-95 transition-transform">
                New Transaction
            </a>
        </div>
    </div>
</x-app-layout>
