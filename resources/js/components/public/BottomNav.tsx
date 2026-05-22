import { Link, usePage } from '@inertiajs/react';
import { ShoppingBag, User, ShoppingCart, ClipboardList } from 'lucide-react';

export function BottomNav() {
    const { url } = usePage();
    
    const navItems = [
        { 
            name: 'Cardápio', 
            href: '/', 
            icon: ShoppingBag,
            active: url === '/'
        },
        { 
            name: 'Carrinho', 
            href: '/cart', 
            icon: ShoppingCart,
            active: url.startsWith('/cart')
        },
        { 
            name: 'Pedidos', 
            href: '/my-orders', 
            icon: ClipboardList,
            active: url.startsWith('/my-orders')
        },
        { 
            name: 'Conta', 
            href: '/settings/profile', 
            icon: User,
            active: url.startsWith('/settings/profile')
        },
    ];

    return (
        <nav className="fixed bottom-0 left-0 right-0 z-50 bg-background border-t border-border pb-[calc(env(safe-area-inset-bottom)+0.5rem)] pt-2 px-4">
            <div className="max-w-md mx-auto flex justify-around items-center">
                {navItems.map((item) => (
                    <Link 
                        key={item.name} 
                        href={item.href}
                        className={`flex flex-col items-center gap-1 transition-colors ${
                            item.active ? 'text-primary' : 'text-muted-foreground hover:text-primary'
                        }`}
                    >
                        <item.icon className={`size-6 ${item.active ? 'fill-primary/20' : ''}`} />
                        <span className="text-[10px] font-medium">{item.name}</span>
                    </Link>
                ))}
            </div>
        </nav>
    );
}
