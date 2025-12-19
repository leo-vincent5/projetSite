
<html>
<style>
 p {
     color:#666666;margin-left: 35px; margin-top: -10px;
 }
</style>

<body>
    <div style="background-color: #283592;width: 100%;height: 8px;"></div>
    <h1 style="margin-left: 3vw; margin-top: 1vh; color: #6D64E8">Equicode</h1>
    <p>27 chemin de monteau</p>
    <p>30400 Villeneuve lez avignon</p>
    <p>N° Siret : 89375134700012</p>

    <p style="margin-top: 20px">Dispensé d'immatriculation au Registre du Commerce et des Sociétés (RCS)
et au Répertoire des Métiers (RM) [Article L. 123-1-1 du code du Commerce]
</p>

    <h1 style="margin-left:30px;font-size: 50px;color:#283592;">Facture</h1>
    <table style="width: 100%; margin-left: 30px;">
        <tr style="width: 100%;">
            <td><b>Facture pour</b></td>
            <td><b>Payable à </b></td>
            <td><b>N° de facture</b></td>
        </tr>

        <tr style="width: 100%;">
            <td>{{$employeur->nom}}</td>
            <td>{{\Illuminate\Support\Facades\Auth::user()->fullname}}</td>
            <td>00{{$facture->id}}</td>
        </tr>
    </table>
<hr style="color:#B7B7B7;margin-top: 30px">

<table style="margin-bottom:25px;font-size: 20px;width: 100%;color: #2A3990; margin-left: 30px;">
    <tr style="width: 100%;">
        <td style="width: 400px;"><b>Description</b></td>
        <td><b>Qté</b></td>
        <td><b>Prix unitaire</b></td>
        <td><b>Prix total</b></td>
    </tr>
</table>


<table style="font-size: 15px;width: 100%; margin-left: 30px;">
    @php $cptColor = 0; @endphp
    @php $somme = 0 ; @endphp
    @foreach($activites as $activite)
        @php $cptColor++ @endphp
        @php $somme = $somme + ($activite->prix * $activite->qte) @endphp
        @if ($cptColor == 2)
            <tr style="width: 100%">
            @php $cptColor  = 0 @endphp
        @else
            <tr style="width: 100%; background-color: #F3F3F3;">
        @endif
            <td style="width: 400px;">{{$activite->titre." le ".\Carbon\Carbon::create($activite->date)->format('d/m/Y')}} à {{$activite->lieu}}</td>
            <td>{{$activite->qte}}</td>
            <td>{{number_format($activite->prix,2)}} €</td>
            <td>{{number_format(($activite->prix*$activite->qte),2)}}€</td>
        </tr>
    @endforeach
</table>
<hr style="color:#B7B7B7;margin-top: 30px">
<table style="font-size: 15px;width: 100%; margin-left: 30px;">
    <tr>
        <td style="width: 550px; color:#999999;">Remarques : </td>
        <td style="color: #2A3990">Sous-total</td>
    </tr>
</table>

<table style="font-size: 15px;width: 100%; margin-left: 30px;">
    <tr>
        <td style="width: 550px; color:#999999;"> {{$facture->remarque}}</td>
        <td style="color: #2A3990;font-size: 15px;"><b>{{number_format($somme,2)}} €</b></td>
    </tr>
</table>


<table style="margin-top: 50px;">
    <tr>
        <td style="width: 450px;">&nbsp;</td>
        <td style="color:#666666">tva non applicable art. 293 b du cgi</td>
    </tr>
</table>

</body>

</html>
