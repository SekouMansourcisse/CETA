# 🎯 Guide des Graphiques - Dashboard

## 🚀 Démarrage Rapide

### 1. **Installation des Dépendances**
```bash
npm install
```

### 2. **Construction des Assets**
```bash
npm run build
```

### 3. **Démarrage du Serveur**
```bash
php artisan serve
```

## 📊 Structure des Graphiques

### **Disposition 3x2**
```
┌─────────────────┬─────────────────┬─────────────────┐
│   Projets       │  Réalisations   │     Études      │
│   par Statut    │   par Statut    │   par Statut    │
├─────────────────┼─────────────────┼─────────────────┤
│   Expertises    │  Autorisations  │  Activités      │
│   par Statut    │   par Statut    │   par Type      │
└─────────────────┴─────────────────┴─────────────────┘
```

### **Types de Graphiques**
1. **Projets par Statut** - État des projets (en cours, terminé, etc.)
2. **Réalisations par Statut** - Statut des activités de réalisation
3. **Études par Statut** - Statut des activités d'étude
4. **Expertises par Statut** - Statut des activités d'expertise
5. **Autorisations par Statut** - Statut des activités d'autorisation
6. **Activités par Type** - Répartition par type d'activité

## 🎨 Personnalisation

### **Modifier les Couleurs**
Éditez `resources/js/chart-config.js` :
```javascript
export const chartConfig = {
    defaultColors: [
        '#3B82F6', // Votre couleur personnalisée
        '#10B981', // Votre couleur personnalisée
        // ... autres couleurs
    ]
};
```

### **Modifier la Taille des Graphiques**
Dans `resources/js/chart-config.js` :
```javascript
chart: {
    height: 320, // Modifiez cette valeur
    // ...
}
```

### **Modifier les Animations**
```javascript
animations: {
    enabled: true,
    speed: 800, // Vitesse des animations
    easing: 'easeinout' // Type d'animation
}
```

## 🔧 Maintenance

### **Ajouter un Nouveau Graphique**

1. **Ajouter dans le contrôleur** (`app/Http/Controllers/HomeController.php`) :
```php
// Récupérer les données
$newChartData = Model::select('field', DB::raw('count(*) as count'))
                     ->groupBy('field')
                     ->pluck('count', 'field')
                     ->toArray();

$newChartLabels = array_keys($newChartData);
$newChartSeries = array_values($newChartData);

// Ajouter dans le compact()
return view('home', compact(
    // ... autres variables
    'newChartLabels',
    'newChartSeries'
));
```

2. **Ajouter dans la vue** (`resources/views/home.blade.php`) :
```html
<div class="col-lg-4 col-md-6">
    <div class="card chart-card">
        <div class="card-header">
            <h5 class="card-title">Titre du Nouveau Graphique</h5>
        </div>
        <div class="card-body">
            <div id="new-chart-id"
                 data-labels="{{ json_encode($newChartLabels) }}"
                 data-series="{{ json_encode($newChartSeries) }}">
            </div>
        </div>
    </div>
</div>
```

3. **Ajouter dans charts.js** :
```javascript
createDonutChart('#new-chart-id');
```

### **Modifier le Type de Graphique**

Pour changer un graphique donut en barre, modifiez `chart-config.js` :
```javascript
export const barChartConfig = {
    chart: {
        type: 'bar', // Au lieu de 'donut'
        // ...
    }
    // ...
};
```

## 🐛 Dépannage

### **Graphique ne s'affiche pas**
1. Vérifiez que l'ID dans la vue correspond à celui dans charts.js
2. Vérifiez que les données sont bien passées depuis le contrôleur
3. Ouvrez la console du navigateur pour voir les erreurs JavaScript

### **Erreur de données**
1. Vérifiez que les données ne sont pas vides dans le contrôleur
2. Ajoutez des valeurs par défaut pour les cas vides
3. Vérifiez le format des données (JSON valide)

### **Problème de responsive**
1. Vérifiez les breakpoints dans `chart-config.js`
2. Testez sur différentes tailles d'écran
3. Vérifiez que les CSS media queries sont correctes

## 📱 Responsive Design

### **Breakpoints**
- **≥1200px** : 3 colonnes, hauteur 420px
- **768px-1199px** : 2 colonnes, hauteur 400px
- **<768px** : 1 colonne, hauteur 380px

### **Adaptation Automatique**
Les graphiques s'adaptent automatiquement :
- Taille des polices
- Espacement des légendes
- Taille des marqueurs
- Hauteur des graphiques

## 🎯 Bonnes Pratiques

### **Performance**
- Utilisez `setTimeout` pour éviter les conflits de DOM
- Implémentez le debouncing pour le redimensionnement
- Gestion des erreurs robuste

### **Accessibilité**
- Couleurs avec contraste suffisant
- Légendes claires et lisibles
- Messages d'erreur informatifs

### **Maintenance**
- Code modulaire et réutilisable
- Configuration centralisée
- Documentation claire

## 🔍 Debug

### **Console du Navigateur**
```javascript
// Vérifier qu'un graphique est chargé
document.querySelector('#project-status-chart').classList.contains('chart-loaded')

// Vérifier les données
console.log(document.querySelector('#project-status-chart').dataset)
```

### **Logs PHP**
Dans le contrôleur, ajoutez :
```php
\Log::info('Données des graphiques:', [
    'projectStatuses' => $projectStatuses,
    // ... autres données
]);
```

## 📚 Ressources

- [Documentation ApexCharts](https://apexcharts.com/docs/)
- [Guide des Couleurs](https://coolors.co/)
- [Responsive Design](https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design)

---

**Note** : Ce système est conçu pour être maintenable et extensible. Toute modification doit respecter la cohérence visuelle et la structure existante.
