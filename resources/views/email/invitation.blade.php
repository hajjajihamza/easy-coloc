<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation à rejoindre une colocation</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f8fafc;
            padding: 40px 0;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #334155;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .header {
            background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .content {
            padding: 40px;
            line-height: 1.6;
        }

        .content h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 0;
        }

        .content p {
            margin: 16px 0;
            font-size: 16px;
            color: #475569;
        }

        .colocation-card {
            background-color: #f1f5f9;
            padding: 24px;
            border-radius: 8px;
            margin: 24px 0;
            border: 1px solid #e2e8f0;
        }

        .colocation-name {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            display: block;
            margin-bottom: 4px;
        }

        .colocation-description {
            font-size: 14px;
            color: #64748b;
        }

        .button-container {
            text-align: center;
            margin: 32px 0;
        }

        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.2s;
        }

        .footer {
            padding: 24px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
            background-color: #f8fafc;
        }

        @media only screen and (max-width: 600px) {
            .content {
                padding: 24px;
            }

            .header {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1>Easy Coloc</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2>Vous avez été invité(e) !</h2>
                    <p>Bonjour,</p>
                    <p>Vous avez été invité(e) à rejoindre une colocation sur <strong>Easy Coloc</strong>. Rejoignez vos futurs
                        colocataires et commencez à gérer facilement vos dépenses communes.</p>

                    <div class="colocation-card">
                        <span class="colocation-name">{{ $invitation->colocation->name }}</span>
                        @if ($invitation->colocation->description)
                            <span class="colocation-description">{{ $invitation->colocation->description }}</span>
                        @endif
                    </div>

                    <p>Pour accepter cette invitation et rejoindre le groupe, veuillez cliquer sur le bouton ci-dessous :</p>

                    <div class="button-container">
                        <a href="{{ route('invitations.accept', ['token' => $invitation->token]) }}" class="button">Accepter l'invitation</a>
                        <a href="{{ route('invitations.reject', ['token' => $invitation->token]) }}" class="button" style="background-color: #ef4444; margin-left: 8px;">Refuser l'invitation</a>
                    </div>

                    <p>Si vous ne vous attendiez pas à recevoir cette invitation, vous pouvez ignorer cet email en toute sécurité.</p>
                    <p>Cordialement,<br>L'équipe Easy Coloc</p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} Easy Coloc. Tous droits réservés.
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
