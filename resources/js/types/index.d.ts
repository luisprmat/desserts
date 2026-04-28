export namespace App.Models {
    export type Product = {
        id: number;
        name: string;
        category: string;
        image: string;
        price_cents: number;
        created_at: string;
        updated_at: string;
    };

    export type CartItem = {
        id: number;
        product_id: number;
        cart_id: number;
        quantity: number;
        created_at: string;
        updated_at: string;
        product: App.Models.Product;
    };

    export type Cart = {
        id: number;
        session_id: string;
        created_at: string;
        updated_at: string;
        items: App.Models.CartItem[];
    };
}
