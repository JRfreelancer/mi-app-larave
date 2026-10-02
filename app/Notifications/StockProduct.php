<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockProduct extends Notification
{
    use Queueable;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Alerta de stock bajo: ' . $this->product->name)
            ->greeting('Cordial saludo')
            ->line('El sistema de inventario ha detectado un nivel de stock bajo.')
            ->line('Producto: ' . $this->product->name)
            ->line('Cantidad disponible: ' . $this->product->quantity . ' unidad(es).')
            ->line('El límite establecido es de 10 unidades.')
            ->line('Por favor verificar el inventario.')
            ->salutation('Sistema de gestión de inventario');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'quantity' => $this->product->quantity,
            'message' => 'El producto tiene stock bajo. Por favor verificar el inventario.',
        ];
    }
}
