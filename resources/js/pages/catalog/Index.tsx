import { Head } from '@inertiajs/react';
import { Store, ArrowRight } from 'lucide-react';

interface Tenant {
    id: number;
    name: string;
    slug: string;
    whatsapp: string | null;
    is_active: boolean;
    menu_url: string;
}

interface CatalogIndexProps {
    tenants: Tenant[];
}

export default function CatalogIndex({ tenants }: CatalogIndexProps) {
    return (
        <>
            <Head title="Cardápio Multi - Catálogo" />
            <div className="min-h-screen bg-background flex flex-col">
                <header className="bg-primary text-primary-foreground p-8 text-center">
                    <Store className="size-12 mx-auto mb-4" />
                    <h1 className="text-4xl font-bold mb-2">Cardápio Multi</h1>
                    <p className="text-lg opacity-90">Escolha um restaurante para ver o cardápio</p>
                </header>

                <main className="flex-1 container mx-auto px-4 py-8">
                    {tenants.length === 0 ? (
                        <div className="text-center py-20">
                            <p className="text-muted-foreground text-lg">
                                Nenhum restaurante disponível no momento.
                            </p>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
                            {tenants.map((tenant) => (
                                <a
                                    key={tenant.id}
                                    href={tenant.menu_url}
                                    className="group bg-card border border-border rounded-xl p-6 hover:shadow-lg transition-all hover:border-primary/50 hover:-translate-y-1"
                                >
                                    <div className="flex items-center justify-between mb-4">
                                        <div className="size-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <Store className="size-6 text-primary" />
                                        </div>
                                        <ArrowRight className="size-5 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" />
                                    </div>
                                    <h2 className="text-xl font-semibold mb-1">{tenant.name}</h2>
                                    <p className="text-sm text-muted-foreground">
                                        Ver cardápio →
                                    </p>
                                </a>
                            ))}
                        </div>
                    )}
                </main>

                <footer className="border-t py-4 text-center text-sm text-muted-foreground">
                    Cardápio Digital Multi-tenant
                </footer>
            </div>
        </>
    );
}
