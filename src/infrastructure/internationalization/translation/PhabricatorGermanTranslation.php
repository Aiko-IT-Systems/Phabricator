<?php

final class PhabricatorGermanTranslation
  extends PhutilTranslation {

  public function getLocaleCode() {
    return 'de_DE';
  }

  protected function getTranslations() {
    return array(
      'No daemon(s) with id(s) "%s" exist!' => array(
        'Es existiert kein Dienst mit der id %s !',
        'Es existieren keine Dienste mit den ids %s !',
      ),
      'These %d configuration value(s) are related:' => array(
        'Dieser Konfigurationswert ist zugehörig:',
        'Diese Konfigurationswerte sind zugehörig:',
      ),
      '%s Task(s)' => array('Aufgabe', 'Aufgaben'),

      '%s ERROR(S)' => array('FEHLER', 'FEHLER'),
      '%d Error(s)' => '%d Fehler',
      '%d Warning(s)' => array('%d Warnung', '%d Warnungen'),
      '%d Auto-Fix(es)' => array('%d Auto-Fix', '%d Auto-Fixes'),
      '%d Advice(s)' => array('%d Ratschlag', '%d Ratschläge'),
      '%d Detail(s)' => array('%d Detail', '%d Details'),

      '(%d line(s))' => array('(%d Zeile)', '(%d Zeilen)'),

      '%d line(s)' => array('%d Zeile', '%d Zeilen'),
      '%d path(s)' => array('%d Pfad', '%d Pfade'),
      '%d diff(s)' => array('%d diff', '%d diffs'),

      '%d Answer(s)' => array('eine Antwort', '%d Antworten'),
      'Show %d Comment(s)' => array('Zeige einen Kommentar', 'Zeige %d Kommentare'),

      '%s DIFF LINK(S)' => array('DIFF LINK', 'DIFF LINKS'),
      'You successfully created %d diff(s).' => array(
        'Du hast erfolgreich %d diff erstellt.',
        'Du hast erfolgreich %d diffs erstellt.',
      ),
      'Diff creation failed; see body for %s error(s).' => array(
        'Diff Erstellung fehlgeschlagen; siehe Hauptteil für Fehlermeldung.',
        'Diff Erstellung fehlgeschlagen; siehe Hauptteil für Fehlermeldungen.',
      ),

      'There are %d raw fact(s) in storage.' => array(
        'There is %d raw fact in storage.',
        'There are %d raw facts in storage.',
      ),

      'There are %d aggregate fact(s) in storage.' => array(
        'There is %d aggregate fact in storage.',
        'There are %d aggregate facts in storage.',
      ),

      '%d Commit(s) Awaiting Audit' => array(
        'ein Commit erwartet Audit',
        '%d Commits erwarten Audit',
      ),

      '%d Problem Commit(s)' => array(
        '%d Problem Commit',
        '%d Problem Commits',
      ),

      '%d Review(s) Blocking Others' => array(
        '%d Review blockiert Andere',
        '%d Reviews blockieren Andere',
      ),

      '%d Review(s) Need Attention' => array(
        '%d Review benötigt Aufmerksamkeit',
        '%d Reviews benötigen Aufmerksamkeit',
      ),

      '%d Review(s) Waiting on Others' => array(
        '%d Review Waiting on Others',
        '%d Reviews Waiting on Others',
      ),

      '%d Active Review(s)' => array(
        '%d Active Review',
        '%d Active Reviews',
      ),

      '%d Flagged Object(s)' => array(
        '%d Flagged Object',
        '%d Flagged Objects',
      ),

      '%d Object(s) Tracked' => array(
        '%d Object Tracked',
        '%d Objects Tracked',
      ),

      '%d Assigned Task(s)' => array(
        '%d zugeteilte Aufgabe',
        '%d zugeteilte Aufgaben',
      ),

      'Show %d Lint Message(s)' => array(
        'Zeige %d Lint Nachricht',
        'Zeige %d Lint Nachrichten',
      ),
      'Hide %d Lint Message(s)' => array(
        'Verberge eine Lint Nachricht',
        'Verberge %d Lint Nachrichten',
      ),

      'This is a binary file. It is %s byte(s) in length.' => array(
        'Dies ist eine Binärdatei. Sie ist %s byte groß.',
        'Dies ist eine Binärdatei. Sie ist %s bytes groß.',
      ),

      '%d Action(s) Have No Effect' => array(
        'Aktion hat keine Auswirkung',
        '%d Aktionen haben keine Auswirkung',
      ),

      '%d Action(s) With No Effect' => array(
        'Aktion ohne Auswirkung',
        '%d Aktionen ohne Auswirkung',
      ),

      'Some of your %d action(s) have no effect:' => array(
        'Eine deiner %d Aktionen hat keine Auswirkung:',
        'Einige deiner %d Aktionen haben keine Auswirkung:',
      ),

      'Apply remaining %d action(s)?' => array(
        'Verbleibende Aktion ausführen?',
        'Verbleibende Aktionen ausführen?',
      ),

      'Apply %d Other Action(s)' => array(
        'Verbleibende Aktion anwenden',
        'Verbleibende Aktionen anwenden',
      ),

      'The %d action(s) you are taking have no effect:' => array(
        'Die momentane Aktion hat keine Auswirkung:',
        'Die momentanen Aktionen haben keine Auswirkung:',
      ),

      '%s edited member(s), added %d: %s; removed %d: %s.' =>
        '%s bearbeitete Mitglieder, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s member(s): %s.' => array(
        array(
          '%s fügte ein Mitglied hinzu: %3$s.',
          '%s fügte Mitglieder hinzu: %3$s.',
        ),
      ),

      '%s removed %s member(s): %s.' => array(
        array(
          '%s entfernte ein Mitglied: %3$s.',
          '%s entfernte Mitglieder: %3$s.',
        ),
      ),

      '%s edited project(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Projekte, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s project(s): %s.' => array(
        array(
          '%s fügte ein Projekt hinzu: %3$s.',
          '%s fügte Projekte hinzu: %3$s.',
        ),
      ),

      '%s removed %s project(s): %s.' => array(
        array(
          '%s entfernte ein Projekt: %3$s.',
          '%s entfernte Projekte: %3$s.',
        ),
      ),

      '%s merged %d task(s): %s.' => array(
        array(
          '%s führte eine Aufgabe zusammen: %3$s.',
          '%s führte Aufgaben zusammen: %3$s.',
        ),
      ),

      '%s merged %d task(s) %s into %s.' => array(
        array(
          '%s führte %3$s in %4$s zusammen.',
          '%s führte Aufgaben %3$s in %4$s zusammen.',
        ),
      ),

      '%s added %s voting user(s): %s.' => array(
        array(
          '%s fügte ein Wähler hinzu: %3$s.',
          '%s fügte Wähler hinzu: %3$s.',
        ),
      ),

      '%s removed %s voting user(s): %s.' => array(
        array(
          '%s entfernte einen Wähler: %3$s.',
          '%s entfernte Wähler: %3$s.',
        ),
      ),

      '%s added %s blocking task(s): %s.' => array(
        array(
          '%s fügte eine blockierende Aufgabe hinzu: %3$s.',
          '%s fügte blockierende Aufgaben hinzu: %3$s.',
        ),
      ),

      '%s added %s blocked task(s): %s.' => array(
        array(
          '%s fügte eine blockierte Aufgabe hinzu: %3$s.',
          '%s fügte blockierte Aufgaben hinzu: %3$s.',
        ),
      ),

      '%s removed %s blocking task(s): %s.' => array(
        array(
          '%s entfernte eine blockierende Aufgabe: %3$s.',
          '%s entfernte blockierende Aufgaben: %3$s.',
        ),
      ),

      '%s removed %s blocked task(s): %s.' => array(
        array(
          '%s entfernte eine blockierte Aufgabe: %3$s.',
          '%s entfernte blockierte Aufgaben: %3$s.',
        ),
      ),

      '%s added %s blocking task(s) for %s: %s.' => array(
        array(
          '%s fügte eine blockierende Aufgabe zu %3$s hinzu: %4$s.',
          '%s fügte blockierende Aufgaben for %3$s hinzu: %4$s.',
        ),
      ),

      '%s added %s blocked task(s) for %s: %s.' => array(
        array(
          '%s fügte eine blockierte Aufgabe zu %3$s hinzu: %4$s.',
          '%s fügte blockierte Aufgaben zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s blocking task(s) for %s: %s.' => array(
        array(
          '%s entfernte eine blockierende Aufgabe von %3$s: %4$s.',
          '%s entfernte blockierende Aufgaben von %3$s: %4$s.',
        ),
      ),

      '%s removed %s blocked task(s) for %s: %s.' => array(
        array(
          '%s entfernte eine blockierte Aufgabe for %3$s: %4$s.',
          '%s entfernte blockierte Aufgaben for %3$s: %4$s.',
        ),
      ),

      '%s edited blocking task(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete blockierende Aufgaben, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s edited blocking task(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete blockierende Aufgaben for %s, hinzugefügt: %4$s; entfernte: %6$s.',

      '%s edited blocked task(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete blockierte Aufgaben, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s edited blocked task(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete blockierte Aufgaben for %s, hinzugefügt: %4$s; entfernte: %6$s.',

      '%s edited answer(s), added %s: %s; removed %d: %s.' =>
        '%s bearbeitete Antworten, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s answer(s): %s.' => array(
        array(
          '%s fügte eine Antwort hinzu: %3$s.',
          '%s fügte Antworten hinzu: %3$s.',
        ),
      ),

      '%s removed %s answer(s): %s.' => array(
        array(
          '%s entfernte eine Antwort: %3$s.',
          '%s entfernte Antworten: %3$s.',
        ),
      ),

     '%s edited question(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Fragen, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s question(s): %s.' => array(
        array(
          '%s fügte eine Frage hinzu: %3$s.',
          '%s fügte Fragen hinzu: %3$s.',
        ),
      ),

      '%s removed %s question(s): %s.' => array(
        array(
          '%s entfernte ein Frage: %3$s.',
          '%s entfernte Fragen: %3$s.',
        ),
      ),

      '%s edited mock(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete mocks, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s mock(s): %s.' => array(
        array(
          '%s fügte ein mock hinzu: %3$s.',
          '%s fügte mocks hinzu: %3$s.',
        ),
      ),

      '%s removed %s mock(s): %s.' => array(
        array(
          '%s entfernte ein mock: %3$s.',
          '%s entfernte mocks: %3$s.',
        ),
      ),

      '%s added %s task(s): %s.' => array(
        array(
          '%s fügte eine Aufgabe hinzu: %3$s.',
          '%s fügte Aufgaben hinzu: %3$s.',
        ),
      ),

      '%s removed %s task(s): %s.' => array(
        array(
          '%s entfernte eine Aufgabe: %3$s.',
          '%s entfernte Aufgaben: %3$s.',
        ),
      ),

      '%s edited file(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Dateien, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s file(s): %s.' => array(
        array(
          '%s fügte eine Datei hinzu: %3$s.',
          '%s fügte Dateien hinzu: %3$s.',
        ),
      ),

      '%s removed %s file(s): %s.' => array(
        array(
          '%s entfernte eine Datei: %3$s.',
          '%s entfernte Dateien: %3$s.',
        ),
      ),

      '%s edited contributor(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete contributors, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s contributor(s): %s.' => array(
        array(
          '%s fügte ein contributor hinzu: %3$s.',
          '%s fügte contributors hinzu: %3$s.',
        ),
      ),

      '%s removed %s contributor(s): %s.' => array(
        array(
          '%s entfernte ein contributor: %3$s.',
          '%s entfernte contributors: %3$s.',
        ),
      ),

      '%s edited %s reviewer(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reviewers, hinzugefügt: %4$s; entfernte: %6$s.',

      '%s edited %s reviewer(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reviewers for %3$s, hinzugefügt: %5$s; entfernte: %7$s.',

      '%s added %s reviewer(s): %s.' => array(
        array(
          '%s fügte ein reviewer hinzu: %3$s.',
          '%s fügte reviewers hinzu: %3$s.',
        ),
      ),

      '%s added %s reviewer(s) for %s: %s.' => array(
        array(
          '%s fügte einen reviewer zu %3$s hinzu: %4$s.',
          '%s added reviewers for %3$s: %4$s.',
        ),
      ),

      '%s removed %s reviewer(s): %s.' => array(
        array(
          '%s entfernte einen reviewer: %3$s.',
          '%s entfernte reviewers: %3$s.',
        ),
      ),

      '%s removed %s reviewer(s) for %s: %s.' => array(
        array(
          '%s entfernte einen reviewer von %3$s: %4$s.',
          '%s entfernte reviewers von %3$s: %4$s.',
        ),
      ),

      '%d other(s)' => array(
        '1 anderer',
        '%d andere',
      ),

      '%s edited subscriber(s), added %d: %s; removed %d: %s.' =>
        '%s bearbeitete Abonnenten, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %d subscriber(s): %s.' => array(
        array(
          '%s fügte einen Abonnenten hinzu: %3$s.',
          '%s fügte Abonnenten hinzu: %3$s.',
        ),
      ),

      '%s removed %d subscriber(s): %s.' => array(
        array(
          '%s entfernte einen Abonnenten: %3$s.',
          '%s entfernte Abonnenten: %3$s.',
        ),
      ),

      '%s edited watcher(s), added %s: %s; removed %d: %s.' =>
        '%s bearbeitete Beobachter, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %s watcher(s): %s.' => array(
        array(
          '%s fügte einen Beobachter hinzu: %3$s.',
          '%s fügte Beobachter hinzu: %3$s.',
        ),
      ),

      '%s removed %s watcher(s): %s.' => array(
        array(
          '%s entfernte einen Beobachter: %3$s.',
          '%s entfernte Beobachter: %3$s.',
        ),
      ),

      '%s edited participant(s), added %d: %s; removed %d: %s.' =>
        '%s bearbeitete Teilnehmer, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s added %d participant(s): %s.' => array(
        array(
          '%s fügte einen Teilnehmer hinzu: %3$s.',
          '%s fügte Teilnehmer hinzu: %3$s.',
        ),
      ),

      '%s removed %d participant(s): %s.' => array(
        array(
          '%s entfernte einen Teilnehmer: %3$s.',
          '%s entfernte Teilnehmer: %3$s.',
        ),
      ),

      '%s edited image(s), added %d: %s; removed %d: %s.' =>
        '%s bearbeitete Bilder, hizugefügt: %3$s; entfernt: %5$s',

      '%s added %d image(s): %s.' => array(
        array(
          '%s fügte ein Bild hinzu: %3$s.',
          '%s fügte Bilder hinzu: %3$s.',
        ),
      ),

      '%s removed %d image(s): %s.' => array(
        array(
          '%s entfernte ein Bild: %3$s.',
          '%s entfernte Bilder: %3$s.',
        ),
      ),

      '%s Line(s)' => array(
        '%s Zeile',
        '%s Zeilen',
      ),

      'Indexing %d object(s) of type %s.' => array(
        'Indexing %d object of type %s.',
        'Indexing %d object of type %s.',
      ),

      'Run these %d command(s):' => array(
        'Run this command:',
        'Run these commands:',
      ),

      'Install these %d PHP extension(s):' => array(
        'Install this PHP extension:',
        'Install these PHP extensions:',
      ),

      'The current Phabricator configuration has these %d value(s):' => array(
        'The current Phabricator configuration has this value:',
        'The current Phabricator configuration has these values:',
      ),

      'The current MySQL configuration has these %d value(s):' => array(
        'The current MySQL configuration has this value:',
        'The current MySQL configuration has these values:',
      ),

      'You can update these %d value(s) here:' => array(
        'You can update this value here:',
        'You can update these values here:',
      ),

      'The current PHP configuration has these %d value(s):' => array(
        'The current PHP configuration has this value:',
        'The current PHP configuration has these values:',
      ),

      'To update these %d value(s), edit your PHP configuration file.' => array(
        'To update this %d value, edit your PHP configuration Datei.',
        'To update these %d values, edit your PHP configuration Datei.',
      ),

      'To update these %d value(s), edit your PHP configuration Datei, located '.
      'here:' => array(
        'To update this value, edit your PHP configuration File, located '.
        'here:',
        'To update these values, edit your PHP configuration File, located '.
        'here:',
      ),

      'PHP also loaded these %s configuration file(s):' => array(
        'PHP also loaded this configuration File:',
        'PHP also loaded these configuration Files:',
      ),

      'You have %d unresolved setup issue(s)...' => array(
        'You have an unresolved setup issue...',
        'You have %d unresolved setup issues...',
      ),

      '%s added %d inline comment(s).' => array(
        array(
          '%s fügte einen Zeilen-Kommentar hinzu.',
          '%s fügte Zeilen-Kommentare hinzu.',
        ),
      ),

      '%d comment(s)' => array('%d Kommentar', '%d Kommentare'),
      '%d rejection(s)' => array('%d Ablehnung', '%d Ablehnungen'),
      '%d update(s)' => array('%d update', '%d updates'),

      'This configuration value is defined in these %d '.
      'configuration source(s): %s.' => array(
        'This configuration value is defined in this '.
        'configuration source: %2$s.',
        'This configuration value is defined in these %d '.
        'configuration sources: %s.',
      ),

      '%d Open Pull Request(s)' => array(
        '%d Open Pull Request',
        '%d Open Pull Requests',
      ),

      'Stale (%s day(s))' => array(
        'Abgestanden (%s Tag)',
        'Abgestanden (%s Tage)',
      ),

      'Old (%s day(s))' => array(
        'Alt (%s Tag)',
        'Alt (%s Tage)',
      ),

      '%s Commit(s)' => array(
        '%s Commit',
        '%s Commits',
      ),

      '%s attached %d file(s): %s.' => array(
        array(
          '%s hängte eine Datei an: %3$s.',
          '%s hängte Dateien an: %3$s.',
        ),
      ),

      '%s detached %d file(s): %s.' => array(
        array(
          '%s entfernte eine Datei: %3$s.',
          '%s entfernte Dateien: %3$s.',
        ),
      ),

      '%s changed file(s), attached %d: %s; detached %d: %s.' =>
        '%s änderte Dateien, angehängt: %3$s; entfernt: %5$s.',


      '%s added %s dependencie(s): %s.' => array(
        array(
          '%s fügte eine Abhängigkeit hinzu: %3$s.',
          '%s fügte Abhängigkeiten hinzu: %3$s.',
        ),
      ),

      '%s added %s dependencie(s) for %s: %s.' => array(
        array(
          '%s fügte eine Abhängigkeit zu %3$s hinzu: %4$s.',
          '%s fügte Abhängigkeiten zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s dependencie(s): %s.' => array(
        array(
          '%s entfernte eine Abhängigkeit: %3$s.',
          '%s entfernte Abhängigkeiten: %3$s.',
        ),
      ),

      '%s removed %s dependencie(s) for %s: %s.' => array(
        array(
          '%s entfernte eine Abhängigkeit von %3$s: %4$s.',
          '%s entfernte Abhängigkeiten von %3$s: %4$s.',
        ),
      ),

      '%s edited dependencie(s), added %s: %s; removed %s: %s.' => array(
        '%s bearbeitete Abhängigkeiten, hizugefügt: %3$s; entfernt: %5$s',
      ),

      '%s edited dependencie(s) for %s, added %s: %s; removed %s: %s.' => array(
        '%s bearbeitete Abhängigkeiten von %s, hizugefügt: %3$s; entfernt: %5$s',
      ),

      '%s added %s dependent revision(s): %s.' => array(
        array(
          '%s fügte eine abhängige revision hinzu: %3$s.',
          '%s fügte abhängige revisionen hinzu: %3$s.',
        ),
      ),

      '%s added %s dependent revision(s) for %s: %s.' => array(
        array(
          '%s fügte eine abhängige revision zu %3$s hinzu: %4$s.',
          '%s fügte abhängige revisionen zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s dependent revision(s): %s.' => array(
        array(
          '%s entfernte eine abhängige revision: %3$s.',
          '%s entfernte abhängige revisionen: %3$s.',
        ),
      ),

      '%s removed %s dependent revision(s) for %s: %s.' => array(
        array(
          '%s entfernte eine abhängige revision von %3$s: %4$s.',
          '%s entfernte abhängige revisionen von %3$s: %4$s.',
        ),
      ),

      '%s added %s commit(s): %s.' => array(
        array(
          '%s fügte ein commit hinzu: %3$s.',
          '%s fügte commits hinzu: %3$s.',
        ),
      ),

      '%s removed %s commit(s): %s.' => array(
        array(
          '%s entfernte ein commit: %3$s.',
          '%s entfernte commits: %3$s.',
        ),
      ),

      '%s edited commit(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete commits, hizugefügt: %3$s; entfernt: %5$s',

      '%s added %s reverted commit(s): %s.' => array(
        array(
          '%s fügte ein reverted commit hinzu: %3$s.',
          '%s fügte reverted commits hinzu: %3$s.',
        ),
      ),

      '%s removed %s reverted commit(s): %s.' => array(
        array(
          '%s entfernte ein reverted commit: %3$s.',
          '%s entfernte reverted commits: %3$s.',
        ),
      ),

      '%s edited reverted commit(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reverted commits, hinzugefügt  %3$s; entfernt %5$s.',

      '%s added %s reverted commit(s) for %s: %s.' => array(
        array(
          '%s fügte ein reverted commit für %3$s hinzu: %4$s.',
          '%s fügte reverted commits für %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s reverted commit(s) for %s: %s.' => array(
        array(
          '%s entfernte ein reverted commit for %3$s: %4$s.',
          '%s entfernte reverted commits for %3$s: %4$s.',
        ),
      ),

      '%s edited reverted commit(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reverted commits for %2$s, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s reverting commit(s): %s.' => array(
        array(
          '%s fügte ein reverting commit hinzu: %3$s.',
          '%s fügte reverting commits hinzu: %3$s.',
        ),
      ),

      '%s removed %s reverting commit(s): %s.' => array(
        array(
          '%s entfernte ein reverting commit: %3$s.',
          '%s entfernte reverting commits: %3$s.',
        ),
      ),

      '%s edited reverting commit(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reverting commits, hinzugefügt  %3$s; entfernt %5$s.',

      '%s added %s reverting commit(s) for %s: %s.' => array(
        array(
          '%s fügte ein reverting commit für %3$s hinzu: %4$s.',
          '%s fügte reverting commitsi für %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s reverting commit(s) for %s: %s.' => array(
        array(
          '%s entfernte ein reverting commit for %3$s: %4$s.',
          '%s entfernte reverting commits for %3$s: %4$s.',
        ),
      ),

      '%s edited reverting commit(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete reverting commits for %s, hinzugefügt %4$s; entfernt %6$s.',

      '%s changed project member(s), added %d: %s; removed %d: %s.' =>
        '%s änderte Projekt Mitglieder, hinzugefügt  %3$s; entfernt %5$s.',

      '%s added %d project member(s): %s.' => array(
        array(
          '%s fügte ein Mitglied hinzu: %3$s.',
          '%s fügte Mitglieder hinzu: %3$s.',
        ),
      ),

      '%s removed %d project member(s): %s.' => array(
        array(
          '%s entfernte ein Mitglied: %3$s.',
          '%s entfernte Mitglieder: %3$s.',
        ),
      ),

      '%d project hashtag(s) are already used: %s.' => array(
          'Projekt Hashtag %2$s wird bereits benutzt.',
          '%d Projekt Hashtags werden bereits benutzt: %2$s.',
      ),

      '%s changed project hashtag(s), added %d: %s; removed %d: %s.' =>
        '%s änderte die Projekt Hashtags, hinzugefügt  %3$s; entfernt %5$s.',

      '%s added %d project hashtag(s): %s.' => array(
        array(
          '%s fügte einen Hashtag hinzu: %3$s.',
          '%s fügte Hashtags hinzu: %3$s.',
        ),
      ),

      '%s removed %d project hashtag(s): %s.' => array(
        array(
          '%s entfernte einen Hashtag: %3$s.',
          '%s entfernte Hashtags: %3$s.',
        ),
      ),

      '%s changed %s hashtag(s), added %d: %s; removed %d: %s.' =>
        '%s änderte hashtags von %s, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %d %s hashtag(s): %s.' => array(
        array(
          '%s fügte einen hashtag zu %3$s hinzu: %4$s.',
          '%s fügte hashtags zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %d %s hashtag(s): %s.' => array(
        array(
          '%s entfernte ein hashtag von %3$s: %4$s.',
          '%s entfernte hashtags von %3$s: %4$s.',
        ),
      ),

      '%d User(s) Need Approval' => array(
        '%d User Needs Approval',
        '%d Users Need Approval',
      ),

      '%s older changes(s) are hidden.' => array(
        '%d ältere Änderung ist ausgeblendet.',
        '%d ältere Änderungen sind ausgeblendet.',
      ),

      '%s, %s line(s)' => array(
        '%s, %s Zeile',
        '%s, %s Zeilen',
      ),

      '%s pushed %d commit(s) to %s.' => array(
        array(
          '%s pushed ein commit to %3$s.',
          '%s pushed %d commits to %s.',
        ),
      ),

      '%s commit(s)' => array(
        'ein commit',
        '%s commits',
      ),

      '%s removed %s JIRA issue(s): %s.' => array(
        array(
          '%s entfernte ein JIRA issue: %3$s.',
          '%s entfernte JIRA issues: %3$s.',
        ),
      ),

      '%s added %s JIRA issue(s): %s.' => array(
        array(
          '%s fügte ein JIRA issue hinzu: %3$s.',
          '%s fügte JIRA issues hinzu: %3$s.',
        ),
      ),

      '%s added %s required legal document(s): %s.' => array(
        array(
          '%s fügte ein erforderliches legal Document hinzu: %3$s.',
          '%s fügte erforderliche legal documents hinzu: %3$s.',
        ),
      ),

      '%s updated JIRA issue(s): added %s %s; removed %d %s.' =>
        '%s updated JIRA issues: hinzugefügt  %3$s; entfernt %5$s.',

      '%s edited %s task(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Aufgaben, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s task(s) to %s: %s.' => array(
        array(
          '%s fügte eine Aufgabe zu %3$s hinzu: %4$s.',
          '%s fügte Aufgaben zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s task(s) from %s: %s.' => array(
        array(
          '%s entfernte eine Aufgabe from %3$s: %4$s.',
          '%s entfernte Aufgaben from %3$s: %4$s.',
        ),
      ),

      '%s edited %s task(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Aufgaben für %3$s, hinzugefügt: %5$s; entfernt %7$s.',

      '%s edited %s commit(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete commits, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s commit(s) to %s: %s.' => array(
        array(
          '%s fügte ein commit zu %3$s hinzu: %4$s.',
          '%s fügte commits zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s commit(s) from %s: %s.' => array(
        array(
          '%s entfernte ein commit from %3$s: %4$s.',
          '%s entfernte commits from %3$s: %4$s.',
        ),
      ),

      '%s edited %s commit(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete commits for %3$s, hinzugefügt: %5$s; entfernt %7$s.',

      '%s added %s revision(s): %s.' => array(
        array(
          '%s fügte eine Revision hinzu: %3$s.',
          '%s fügte Revisionen hinzu: %3$s.',
        ),
      ),

      '%s removed %s revision(s): %s.' => array(
        array(
          '%s entfernte eine Revision: %3$s.',
          '%s entfernte Revisionen: %3$s.',
        ),
      ),

      '%s edited %s revision(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Revisionen, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s revision(s) to %s: %s.' => array(
        array(
          '%s fügte eine Revision zu %3$s hinzu: %4$s.',
          '%s fügte Revisionen zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s revision(s) from %s: %s.' => array(
        array(
          '%s entfernte eine Revision von %3$s: %4$s.',
          '%s entfernte Revisionenen von %3$s: %4$s.',
        ),
      ),

      '%s edited %s revision(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Revisionen for %3$s, hinzugefügt: %5$s; entfernt %7$s.',

      '%s edited %s project(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Projekte, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s project(s) to %s: %s.' => array(
        array(
          '%s fügte ein Projekt zu %3$s hinzu: %4$s.',
          '%s fügte Projekte zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s project(s) from %s: %s.' => array(
        array(
          '%s entfernte ein Projekt von %3$s: %4$s.',
          '%s entfernte Projekte von %3$s: %4$s.',
        ),
      ),

      '%s edited %s project(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete Projekte for %3$s, hinzugefügt: %5$s; entfernt %7$s.',

      '%s added %s panel(s): %s.' => array(
        array(
          '%s fügte ein panel hinzu: %3$s.',
          '%s fügte panels hinzu: %3$s.',
        ),
      ),

      '%s removed %s panel(s): %s.' => array(
        array(
          '%s entfernte ein panel: %3$s.',
          '%s entfernte panels: %3$s.',
        ),
      ),

      '%s edited %s panel(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete panels, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s dashboard(s): %s.' => array(
        array(
          '%s fügte ein dashboard hinzu: %3$s.',
          '%s fügte dashboards hinzu: %3$s.',
        ),
      ),

      '%s removed %s dashboard(s): %s.' => array(
        array(
          '%s entfernte ein dashboard: %3$s.',
          '%s entfernte dashboards: %3$s.',
        ),
      ),

      '%s edited %s dashboard(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete dashboards, hinzugefügt %4$s; entfernt %6$s.',

      '%s added %s edge(s): %s.' => array(
        array(
          '%s fügte an edge hinzu: %3$s.',
          '%s fügte edges hinzu: %3$s.',
        ),
      ),

      '%s added %s edge(s) to %s: %s.' => array(
        array(
          '%s fügte an edge zu %3$s hinzu: %4$s.',
          '%s fügte edges zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s edge(s): %s.' => array(
        array(
          '%s entfernte an edge: %3$s.',
          '%s entfernte edges: %3$s.',
        ),
      ),

      '%s removed %s edge(s) from %s: %s.' => array(
        array(
          '%s entfernte an edge von %3$s: %4$s.',
          '%s entfernte edges von %3$s: %4$s.',
        ),
      ),

      '%s edited edge(s), added %s: %s; removed %s: %s.' =>
        '%s bearbeitete edges, hinzugefügt: %3$s; entfernt: %5$s.',

      '%s edited %s edge(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbeitete edges for %3$s, hinzugefügt: %5$s; entfernt %7$s.',

      '%s added %s member(s) for %s: %s.' => array(
        array(
          '%s fügte ein Mitglied zu %3$s hinzu: %4$s.',
          '%s fügte Mitglieder zu %3$s hinzu: %4$s.',
        ),
      ),

      '%s removed %s member(s) for %s: %s.' => array(
        array(
          '%s entfernte ein Mitglied von %3$s: %4$s.',
          '%s entfernte Mitglieder von %3$s: %4$s.',
        ),
      ),

      '%s edited %s member(s) for %s, added %s: %s; removed %s: %s.' =>
        '%s bearbetete Mitglieder von %3$s, hizugefügt: %5$s; entfernt %7$s.',

      '%d related link(s):' => array(
        'Related link:',
        'Related links:',
      ),

      'You have %d unpaid invoice(s).' => array(#Bookmark
        'You have an unpaid invoice.',
        'You have unpaid invoices.',
      ),

      'The configurations differ in the following %s way(s):' => array(
        'The configurations differ:',
        'The configurations differ in these ways:',
      ),

      'Phabricator is configured with an email domain whitelist (in %s), so '.
      'only users with a verified email address at one of these %s '.
      'allowed domain(s) will be able to register an account: %s' => array(
        array(
          'Phabricator is configured with an email domain whitelist (in %s), '.
          'so only users with a verified email address at %3$s will be '.
          'allowed to register an account.',
          'Phabricator is configured with an email domain whitelist (in %s), '.
          'so only users with a verified email address at one of these '.
          'allowed domains will be able to register an account: %3$s',
        ),
      ),

      'Show First %d Line(s)' => array(
        'Zeige erste Zeile',
        'Zeige die ersten %d Zeilen',
      ),

      "\xE2\x96\xB2 Show %d Line(s)" => array(
        "\xE2\x96\xB2 Zeige Zeile",
        "\xE2\x96\xB2 Zeige %d Zeilen",
      ),

      'Show All %d Line(s)' => array(
        'Zeige Zeile',
        'Zeige alle %d Zeilen',
      ),

      "\xE2\x96\xBC Show %d Line(s)" => array(
        "\xE2\x96\xBC Zeige Zeile",
        "\xE2\x96\xBC Zeige %d Zeilen",
      ),

      'Show Last %d Line(s)' => array(
        'Zeige letzte Zeile',
        'Zeige die letzten %d Zeilen',
      ),

      '%s marked %s Zeilen-Kommentar(s) als erledigt and %s Zeilen-Kommentar(s) as '.
      'not done.' => array(
        array(
          array(
            '%s markierte einen Zeilen-Kommentar als erledigt und einen Zeilen-Kommentar '.
            'als nicht erledigt.',
            '%s markierte einen Zeilen-Kommentar als erledigt und %3$s Zeilen-Kommentare '.
            'als nicht erledigt.',
          ),
          array(
            '%s markierte %s Zeilen-Kommentare als erledigt und einen Zeilen-Kommentar '.
            'als nicht erledigt.',
            '%s markierte %s Zeilen-Kommentare als erledigt und %s Zeilen-Kommentare '.
            'als nicht erledigt.',
          ),
        ),
      ),

      '%s marked %s inline comment(s) as done.' => array(
        array(
          '%s marked einen Zeilen-Kommentar als erledigt.',
          '%s marked %s Zeilen-Kommentare als erledigt.',
        ),
      ),

      '%s marked %s inline comment(s) as not done.' => array(
        array(
          '%s markierte einen Zeilen-Kommentar als nicht erledigt.',
          '%s markierte %s Zeilen-Kommentare als nicht erledigt.',
        ),
      ),
      
      'These %s object(s) will be destroyed forever:' => array(
        'Dieses Objekt wird für immer zerstört werden:',
        'Diese Objekte werden für immer zerstört:',
      ),

      'Are you absolutely certain you want to destroy these %s '.
      'object(s)?' => array(
        'Are you absolutely certain you want to destroy this object?',
        'Are you absolutely certain you want to destroy these objects?',
      ),

      '%s added %s owner(s): %s.' => array(
        array(
          '%s added an owner: %3$s.',
          '%s added owners: %3$s.',
        ),
      ),

      '%s removed %s owner(s): %s.' => array(
        array(
          '%s removed an owner: %3$s.',
          '%s removed owners: %3$s.',
        ),
      ),

      '%s changed %s package owner(s), added %s: %s; removed %s: %s.' => array(
        '%s changed package owners, added: %4$s; removed: %6$s.',
      ),

      'Found %s book(s).' => array(
        'Found %s book.',
        'Found %s books.',
      ),
      'Found %s file(s) in project.' => array(
        'Found %s file in project.',
        'Found %s files in project.',
      ),
      'Found %s unatomized, uncached file(s).' => array(
        'Found %s unatomized, uncached file.',
        'Found %s unatomized, uncached files.',
      ),
      'Found %s file(s) to atomize.' => array(
        'Found %s file to atomize.',
        'Found %s files to atomize.',
      ),
      'Atomizing %s file(s).' => array(
        'Atomizing %s file.',
        'Atomizing %s files.',
      ),
      'Creating %s document(s).' => array(
        'Creating %s document.',
        'Creating %s documents.',
      ),
      'Deleting %s document(s).' => array(
        'Deleting %s document.',
        'Deleting %s documents.',
      ),
      'Found %s obsolete atom(s) in graph.' => array(
        'Found %s obsolete atom in graph.',
        'Found %s obsolete atoms in graph.',
      ),
      'Found %s new atom(s) in graph.' => array(
        'Found %s new atom in graph.',
        'Found %s new atoms in graph.',
      ),
      'This call takes %s parameter(s), but only %s are documented.' => array(
        array(
          'This call takes %s parameter, but only %s is documented.',
          'This call takes %s parameter, but only %s are documented.',
        ),
        array(
          'This call takes %s parameters, but only %s is documented.',
          'This call takes %s parameters, but only %s are documented.',
        ),
      ),

      '%s Passed Test(s)' => '%s Passed',
      '%s Failed Test(s)' => '%s Failed',
      '%s Skipped Test(s)' => '%s Skipped',
      '%s Broken Test(s)' => '%s Broken',
      '%s Unsound Test(s)' => '%s Unsound',
      '%s Other Test(s)' => '%s Other',

      '%s Bulk Task(s)' => array(
        '%s Task',
        '%s Tasks',
      ),

      '%s added %s badge(s) for %s: %s.' => array(
        array(
          '%s added a badge for %s: %3$s.',
          '%s added badges for %s: %3$s.',
        ),
      ),
      '%s added %s badge(s): %s.' => array(
        array(
          '%s added a badge: %3$s.',
          '%s added badges: %3$s.',
        ),
      ),
      '%s awarded %s recipient(s) for %s: %s.' => array(
        array(
          '%s awarded %3$s to %4$s.',
          '%s awarded %3$s to multiple recipients: %4$s.',
        ),
      ),
      '%s awarded %s recipients(s): %s.' => array(
        array(
          '%s awarded a recipient: %3$s.',
          '%s awarded multiple recipients: %3$s.',
        ),
      ),
      '%s edited badge(s) for %s, added %s: %s; revoked %s: %s.' => array(
        array(
          '%s edited badges for %s, added %s: %s; revoked %s: %s.',
          '%s edited badges for %s, added %s: %s; revoked %s: %s.',
        ),
      ),
      '%s edited badge(s), added %s: %s; revoked %s: %s.' => array(
        array(
          '%s edited badges, added %s: %s; revoked %s: %s.',
          '%s edited badges, added %s: %s; revoked %s: %s.',
        ),
      ),
      '%s edited recipient(s) for %s, awarded %s: %s; revoked %s: %s.' => array(
        array(
          '%s edited recipients for %s, awarded %s: %s; revoked %s: %s.',
          '%s edited recipients for %s, awarded %s: %s; revoked %s: %s.',
        ),
      ),
      '%s edited recipient(s), awarded %s: %s; revoked %s: %s.' => array(
        array(
          '%s edited recipients, awarded %s: %s; revoked %s: %s.',
          '%s edited recipients, awarded %s: %s; revoked %s: %s.',
        ),
      ),
      '%s revoked %s badge(s) for %s: %s.' => array(
        array(
          '%s revoked a badge for %3$s: %4$s.',
          '%s revoked multiple badges for %3$s: %4$s.',
        ),
      ),
      '%s revoked %s badge(s): %s.' => array(
        array(
          '%s revoked a badge: %3$s.',
          '%s revoked multiple badges: %3$s.',
        ),
      ),
      '%s revoked %s recipient(s) for %s: %s.' => array(
        array(
          '%s revoked %3$s from %4$s.',
          '%s revoked multiple recipients for %3$s: %4$s.',
        ),
      ),

      '%s revoked %s recipients(s): %s.' => array(
        array(
          '%s revoked a recipient: %3$s.',
          '%s revoked multiple recipients: %3$s.',
        ),
      ),

      '%s automatically subscribed target(s) were not affected: %s.' => array(
        'An automatically subscribed target was not affected: %2$s.',
        'Automatically subscribed targets were not affected: %2$s.',
      ),

      'Declined to resubscribe %s target(s) because they previously '.
      'unsubscribed: %s.' => array(
        'Delined to resubscribe a target because they previously '.
        'unsubscribed: %2$s.',
        'Declined to resubscribe targets because they previously '.
        'unsubscribed: %2$s.',
      ),

      '%s target(s) are not subscribed: %s.' => array(
        'A target is not subscribed: %2$s.',
        'Targets are not subscribed: %2$s.',
      ),

      '%s target(s) are already subscribed: %s.' => array(
        'A target is already subscribed: %2$s.',
        'Targets are already subscribed: %2$s.',
      ),

      'Added %s subscriber(s): %s.' => array(
        'Added a subscriber: %2$s.',
        'Added subscribers: %2$s.',
      ),

      'Removed %s subscriber(s): %s.' => array(
        'Removed a subscriber: %2$s.',
        'Removed subscribers: %2$s.',
      ),

      'Queued email to be delivered to %s target(s): %s.' => array(
        'Queued email to be delivered to target: %2$s.',
        'Queued email to be delivered to targets: %2$s.',
      ),

      'Queued email to be delivered to %s target(s), ignoring their '.
      'notification preferences: %s.' => array(
        'Queued email to be delivered to target, ignoring notification '.
        'preferences: %2$s.',
        'Queued email to be delivered to targets, ignoring notification '.
        'preferences: %2$s.',
      ),

      '%s project(s) are not associated: %s.' => array(
        'A project is not associated: %2$s.',
        'Projects are not associated: %2$s.',
      ),

      '%s project(s) are already associated: %s.' => array(
        'A project is already associated: %2$s.',
        'Projects are already associated: %2$s.',
      ),

      'Added %s project(s): %s.' => array(
        'Added a project: %2$s.',
        'Added projects: %2$s.',
      ),

      'Removed %s project(s): %s.' => array(
        'Removed a project: %2$s.',
        'Removed projects: %2$s.',
      ),

      'Added %s reviewer(s): %s.' => array(
        'Added a reviewer: %2$s.',
        'Added reviewers: %2$s.',
      ),

      'Added %s blocking reviewer(s): %s.' => array(
        'Added a blocking reviewer: %2$s.',
        'Added blocking reviewers: %2$s.',
      ),

      'Required %s signature(s): %s.' => array(
        'Required a signature: %2$s.',
        'Required signatures: %2$s.',
      ),

      'Started %s build(s): %s.' => array(
        'Started a build: %2$s.',
        'Started builds: %2$s.',
      ),

      'Added %s auditor(s): %s.' => array(
        'Added an auditor: %2$s.',
        'Added auditors: %2$s.',
      ),

      '%s target(s) do not have permission to see this object: %s.' => array(
        'A target does not have permission to see this object: %2$s.',
        'Targets do not have permission to see this object: %2$s.',
      ),

      'This action has no effect on %s target(s): %s.' => array(
        'This action has no effect on a target: %2$s.',
        'This action has no effect on targets: %2$s.',
      ),

      'Mail sent in the last %s day(s).' => array(
        'Mail sent in the last day.',
        'Mail sent in the last %s days.',
      ),
      #END OF OFFICIEL
      
      
     #Overall ' => '',
      'Create Custom Pages' => 'Erstelle Übersichtsseiten',
      'Explore More Applications' => 'Entdecke mehr Anwendungen',
      'Customize Menu...' => 'Menü anpassen ...',
      'Create' => 'Erstellen',
      'Create New...' => 'Neu erstellen...',
      'Update' => 'Aktualisieren',
      'Continue' => 'Fortfahren',
      'Send' => 'Senden',
      'Submit' => 'Senden',
      'Save' => 'Speichern',
      'Save Changes' => 'Änderungen speichern',
      'Changes saved.' => 'Änderungen gespeichert.',
      'Add Comment' => 'Kommentar hinzufügen',
      'Add Action...' => 'Aktion hinzufügen...',
      'Move on Workboard' => 'Auf Workboard bewegen',
      'Change Project Tags' => 'Projekt Tags ändern',
      'Change Subscribers' => 'Abonnenten ändern',
      'Take Action' => 'Aktiv werden',
      'Join' => 'Beitreten',
      'Cancel' => 'Abbrechen',
      'Close' => 'Schließen',
      'No data.' => 'Keine Daten.',
      'Partial' => 'Teilweise',
      'Partial Upload' => 'Teilweiser Upload',
      'View All' => 'Zeige Alle',
      'All' => 'Alle',
      'Title' => 'Titel',
      'Action' => 'Aktion',
      'Actions' => 'Aktionen',
      'View Raw' => 'Zeige Rohdaten',
      'PREVIEW' => 'VORSCHAU',
      'Preview' => 'Vorschau',
      'Help' => 'Hilfe',
      'Document Preview' => 'Dokument Vorschau',
      'Description Preview' => 'Beschreibungs Vorschau',
      'Configure Form' => 'Form erstellen',
      'Description' => 'Beschreibung',
      'Comments' => 'Kommentare',
      'Author' => 'Autor',
      'Subscribers' => 'Abonnenten',
      'Required' => 'Notwendig',
      'Visible To' => 'Sichtbar für',
      'Editable By' => 'Bearbeitbar von',
      'Policies' => 'Richtlinien',
      'Default' => 'Standard',
      'Prototype' => 'Prototyp',
      '(Show Details)' => '(Zeige Details)',
      'Change Details' => 'Änderungs Details',
      'Updated' => 'Aktualisiert',
      'Loading...' => 'Laden...',
      'None' => 'Niemand',
      'Recent Activity' => 'Neuste Aktivitäten',
      '%s mentioned this in %s.' => '%s erwähnte dies in %s.',
      '%s changed the visibility from "%s" to "%s".' =>
       '%s änderte die Sichtbarkeit von "%s" zu "%s".',
      '%s changed the edit policy from "%s" to "%s".' =>
       '%s änderte die Bearbeitungsrichtlinie von "%s" zu "%s".',
     #Search
      'Search' => 'Suchen',
      'Query' => 'Filter',
      'Edit Query...' => 'Filter bearbeiten...',
      'Edit Query' => 'Filter bearbeiten',
      'Edit Queries...' => 'Filter bearbeiten...',
      'Save Custom Query...' => 'Benutzerdeffinierten Filter speichern',
      'Showing results for query "%s".' => 'Zeige Ergebnisse für Filter "%s".',
      'Showing results for saved query "%s".' => 'Zeige Ergebnisse '.
        'für gespeicherten Filter "%s".',
      'Advanced Search' => 'Erweiterte Suche',
      'No search results.' => 'Nix gefunden.',
      'No results found for this query.' => 'Keine Ergebnisse mit diesem Filter.',
      'Hide Query' => 'Filter verstecken',
      'Execute Query' => 'Suche filtern',
      'Browse Users' => 'Benutzer durchsuchen',
      'Browse Subscribers' => 'Abonnenten durchsuchen',
      'Browse Projects' => 'Projekte durchsuchen',
      'Browse Document Types' => 'Dokument Typen durchsuchen',
      'Select' => 'Auswählen',
      'Search All Documents' => 'Alle Dokumente durchsuchen',
      'Search Current Application' => 'Aktuelle Anwendung durchsuchen',
      'Saved Queries' => 'Gespeicherte Filter',
      'Open Documents' => 'Offene Dokumente',
      'More Options' => 'Mehr Optionen',
     #Edit
      'Edit' => 'Bearbeiten',
      'Edit Comment' => 'Kommentar bearbeiten',
      'Remove Comment' => 'Kommentar entfernen',
      'Bold' => 'Fett',
      'bold text' => 'fetter Text',
      'Italics' => 'Kurisv',
      'italic text' => 'kursiver Text',
      'Monospaced' => 'Unproportional',
      'monospaced text' => 'unproportionaler Text',
      'Bulleted List' => 'Aufzählung',
      'List Item' => 'Listen Eintrag',
      'Numbered List' => 'Nummerierte Aufzählung',
      'Quote' => 'Zitat',
      'Quoted Text' => 'Zitierter Text',
      'Table' => 'Tabelle',
      'data' => 'Daten',
      'Upload File' => 'Datei hochladen',
      'To add files, drag and drop them into the comment text area.' => 'Um Dateien hochzuladen, benutze Drag and Drop und ziehe sie in das Textfeld.',
      'Fullscreen Mode' => 'Vollbild Modus',
      'Type a user, project, package, or mailing list name...' => 'Gib einen Benutzer, Projekt, Packet oder Mailing List Name ein...',
      #'' => '',
     #Icons
      'Icon' => 'Symbol',
      'Travel' => 'Reise',
      'Health / Appointment' => 'Gesundheit / Verabredung',
      'Sabatical / Leave' => 'Forschungsurlaub / Urlaub',
      'Working From Home' => 'Zuhause arbeiten',
      'Holiday' => 'Ferien',
      'Staycation' => 'Urlaub auf Balkonien',
      'Coffee Meeting' => 'Kaffee Runde',
      'Movie' => 'Film',
      'Meeting' => 'Sitzung',
      'Meal' => 'Mahlzeit',
      'Pet Activity' => 'Tier Aktivität',
      'Official Business' => 'Offizielle Geschäfte',
      'Field Trip' => 'Ausflug',
      'Conference' => 'Konferenz',
      'Briefcase' => 'Koffer',
      'Tag' => 'Etikett',
      'Folder' => 'Ordner',
      'Bug' => 'Käfer / Bug',
      'Garbage' => 'Mülleimer',
      'Goal' => 'Ziel',
      'Communication' => 'Kommunikation',
      'Policy' => 'Richtlinie',
      'An Umbrella' => 'Ein Schirm',
      'Umbrella' => 'Schirm',
      'Folder' => 'Ordner',
      'The Cloud' => 'Wolke',
      'Group' => 'Gruppe',
      'Company' => 'Firma',
      'Accounting' => 'Buchhaltung',
      'Experimental' => 'Experimentell',
      #'Like' => '',
      #'Dislike' => '',
      'Love' => 'Herz',
      'Heartbreak' => 'Gebrochenes Herz',
      'Orange Medal' => 'Orangene Medallie',
      'Grey Medal' => 'Graue Medallie',
      'Yellow Medal' => 'Gelbe Medallie',
      'Manufacturing Defect?' => 'Fabrikation Defekt?',
      'Haypence' => 'Centstück',
      'Piece of Eight' => 'Eurostück',
      'Doubloon' => 'Dublone',
      'Mountain of Wealth' => 'Berg von Reichtum',
      'Pterodactyl' => 'Pterodactylus',
      'Evil Spooky Haunted Tree' => 'Böser Gruseliger Spukbaum',
      #'Baby Tequila' => '',
      'The World Burns' => 'Die Welt Brennt!',
     'Colors' => 'Farben',
     'Color' => 'Farbe',
      'Blue' => 'Blau',
      'Red' => 'Rot',
      'Orange' => 'Orange',
      'Yellow' => 'Gelb',
      'Violet' => 'Violett',
      'Green' => 'Grün',
      'Grey' => 'Grau',
      'Checkered' => 'Kariert',
      'Award "%s" Token' => '"%s" Auszeichnung verleihen',
     #Apps
      'All Applications' => 'Alle Programme',
      'Can Use Application' => 'Kann Program benutzen',
      'Can Configure Application' => 'Kann Programm konfigurieren',
     #Differential
      'Review Code' => 'Code überprüfen',
     #Maniphest
//      'Open' =>'Offen',
//      'Resolved' => 'Gelöst',
//      'Wontfix' => 'Nicht behebbar', # dunno 
//      'Invalid' => 'Ungültig',
	'Task Graph' => 'Aufgaben Grafik',
	'Edit Related Tasks...'=>'Editiere zugehörige Aufgaben...',
	'Edit Parent Tasks' => 'Editiere Hauptaufgabe',
	'Edit Subtasks' => 'Editiere Unteraufgabe',
	'Close As Duplicate' => 'Als Dublikat schließen',
	'Edit Related Objects...' => 'Editiere zugehörige Objekte...',
	'Edit Commits' => 'Bearbeite Commits',
	'Edit Mocks' => 'Bearbeite Mocks',
	'Edit Revisions' => 'Bearbeite Revisionen',
      'Tasks and Bugs' => 'Aufgaben und Fehler',
      'Maniphest Help' => 'Maniphest Hilfe',
      'Create Task' => 'Aufgabe erstellen',
      'Maniphest Task' => 'Maniphest Aufgabe',
      'Create New Task' => 'Neue Aufgabe erstellen',
      'Quick Create' => 'Schnell erstellen',
      'Upload Picture' => 'Bild hochladen',
      'Current Picture' => 'Derzeitiges Bild',
      'Use Picture' => 'Nutze Bild',
      'Edit Project Picture' => 'Editiere Projekt Bild',
      'Upload New Picture' => 'Neues Bild hochladen',
      'Choose Icon and Color...' => 'Icon und Farbe wählen...',
      'Type a project name...' => 'Gib einen Projektnamen ein...',
      'Type a username...' => 'Gib einen Benutzernamen ein...',
      'Type a user, project, or mailing list name...' => 'Gib einen Benutzer, '.
         'Projekt, oder Verteiler Namen ein...',
      'Queries' => 'Filter',
      'Query: %s' => 'Filter: %s',
      'Assigned' => 'Zugeteilt',
      'Assigned: %s' => 'Zugeteilt: %s',
      'Authored' => 'Erstellt',
      'Authored By' => 'Erstellt von',
      'Subscribed' => 'Abonniert',
      'Open Tasks' => 'Offene Aufgaben',
      'All Tasks' => 'Alle Aufgaben',
      'By User' => 'Nach Nutzer',
      'By Project' => 'Nach Projekt',
      "Compose Image" => "Bild komponieren",
      "Choose Background Color" => "Hintergrundfarbe wählen",
      "Choose Icon" => "Icon auswählen",
      
      # Eine Aufgabe ist zugeteilt AN Jemanden nicht ZU ?!
      'Assigned To' => 'Zugeteilt an',
      'In All Projects' => 'In allen Projekten',
      'In Any Project' => 'In einem Projekt',
      'Not In Projects' => 'Nicht in Projekten',
      "In Users' Projects" => 'In Projekten von',
      'Authors' => 'Autoren',
      'Abonnenten' => 'Abonnenten',
      'Contains Words' => 'Enthält Wörter',
      'Priority' => 'Priorität',
      'Blocking' => 'Blockierend',
      'Blocked' => 'Blockiert',
      'Group By' => 'Gruppiert nach',
      'Order By' => 'Sortiert nach',
      'Task IDs' => 'Aufgaben IDs',
      'Created After' => 'Erstellt nach',
      'Created Before' => 'Erstellt vor',
      'Updated After' => 'Aktualisiert nach',
      'Updated Before' => 'Aktualisiert vor',
      'Page Size' => 'Seitengröße',
      'Shift-Click to Select Tasks' => 'Shift-Click um Aufgaben auszuwählen',
      'Select All' => 'Alles auswälen',
      'Clear Selection' => 'Alles abwählen',
      'Export to Excel' => 'Zu Excel exportieren',
      'Export Tasks to Excel' => 'Aufgaben als Excel-Tabelle exportieren',
      'Do you want to export the query results to Excel?' =>
       'Möchtest du die Suchergebnisse als Excel-Tabelle exportieren?',
      'Batch Edit Selected »' => 'Stapelverarbeitung der Auswahl',
      'Edit Task' => 'Aufgabe bearbeiten',
      'Save Task' => 'Änderungen speichern',
      'Merge Duplicates In' => 'Duplikat zusammenführen',
      'Create Subtask' => 'Unteraufgabe erstellen',
      'Edit Blocking Tasks' => 'Blockierende Aufgaben bearbeiten',
      #'Edit Differential Revisions' => '?',
      #'Edit Pholio Mocks' => '?',
      'Automatically Subscribed' => 'Automatisch Abonniert',
      'Unsubscribe' => 'Deabonnieren',
      'Subscribe' => 'Abonnieren',
      'Start Tracking Time' => 'Zeit Aufzeichnung starten',
      'What time did you start working?' => 'Wann hast du mit der Arbeit begonnen?',
      'Award Token' => 'Eine Auszeichnung verleihen',
      'Give Token' => 'Token vergeben',
      'New task created. Create another?' => 'Neue Aufgabe erstellt.'.
        ' Eine weitere erstellen?',
      'Similar Task' => 'Ähnliche Aufgabe','Empty Task' => 'Leere Aufgabe',
      'Older changes are hidden. ' => 'Ältere Änderungen sind ausgeblendet. ',
      'Show older changes.' => 'Zeige ältere Änderungen.',
      "Additional Hashtags" => "Zusätzliche Hastags",
      "Joinable By" => "Beitretbar von",
      "Project Members" => "Projekt Mitglieder",
      "Select Project" => "Projekt auswählen",
      "Members Of" => "Mitglied von",
      "Public (No Login Required)" => "Öffentlich (Kein Login)",
      "Object Policies" => "Objekt Richtlinien",
      "Members of Project..." => "Mitglieder von Projekt...",
      "Other Project..." => "Anderes Projekt...",
      "Choose Project Icon" => "Projekt Icon auswählen",
      
      #'' => '',
      '%s created this task.' => '%s erstellte diese Aufgabe',
      '%s closed %s as "%s".' => '%s schließt %s als "%s".',
      '%s updated the image for %s from %s to %s.' => '%s ändert das Bild für %s von %s auf %s.',
      '%s lowered the priority of %s from "%s" to "%s".' => '%s senkt die Priorität für %s von "%s" auf "%s".',
      '%s reopened %s as "%s".' => '%s öffnet erneut %s als "%s".',
      '%s changed the status of %s from "%s" to "%s".' => '%s ändert den Status für %s von "%s" auf "%s".',
      'Weigh In' => 'Äußere dich...',
      '%s added a comment.' => '%s fügte einen Kommentar hinzu.',
      '%s closed this task as a duplicate.' => '%s schloss diese Aufgabe'.
        ' als ein Duplikat.',
      '%s closed this task as "%s".' => '%s schloss diese Aufgsbe als "%s".',
      '%s placed this task up for grabs.' => '%s gab die Aufgabe zum übernehmen frei.',
      '%s assigned this task to %s.' => '%s teilte diese Aufgabe %s zu.',
      '%s claimed this task.' => '%s übernahm diese Aufgabe.',
      '%s updated subscribers...' => '%s aktualisierte Abonnenten...',
      '%s triaged this task as "%s" priority.' => '%s setzte '.
        'die Priorität der Aufgabe auf "%s".',
      '%s removed %s as the assignee of this task.' => '%s '.
        'entfernte %s als den zugewiesenen Bearbeiter dieses Tasks.',
      '%s raised the priority of this task from "%s" to "%s".' => '%s '.
        'erhöhte die Priorität von "%s" auf "%s".',
      '%s reopened this task as "%s".' => '%s '.
        'öffnete diesen Task wieder mit Status "%s".',
      '%s changed the task status from "%s" to "%s".' => '%s '.
        'änderte den Aufgaben Status von "%s" zu "%s"',
      
        
      '%s lowered the priority of this task from "%s" to "%s".' => '%s '.
        'senkte die Priorität von "%s" auf "%s".',
      '%s edited associated projects.' => '%s bearbeitete dazugehörige Projekte.',
      '%s awarded a token.' => '%s verlieh eine Auszeichnung.',
      '%s set %s to %s.' => '%s setzte %s auf %s.',
      '%s edited the task description.' => '%s bearbeitete die Aufgabenbeschreibung.',
      '%s updated the description of %s.' => '%s aktualisierte die Beschreibung von %s',
      '%s changed %s from %s to %s.' => '%s änderte %s von %s zu %s.',
     #Actions
      'View Herald Transcript' => 'Herald Transkript ansehen',
      'Create Notification Rules' => "Erstelle Benachrichtigungs Regeln",
      'Comment' => 'Kommentar',
      'Change Status' => 'Status ändern',
      'Reassign / Claim' => 'Neu zuweisen / Übernehmen',
      'Assign / Claim' => 'Zuweisen / Übernehmen',
      'Add CCs' => 'Abonnenten hizufügen',
      'Change Priority' => 'Priorität ändern',
      'Associate Projects' => 'Projekte hizufügen',
      'Task' => 'Aufgabe',
      "Done" => "Fertig",
      /*'' => '',
      '' => '',
      '' => '',
      '' => '',
      '' => '',*/
     #Diffusion
      'Importing...' => 'Importiert...',
      'Empty Repository' => 'Leeres Repository',
      'Edit Repository' => 'Repository bearbeiten',
      'This repository does not have any commits yet.' =>
       'Diese Repository hat noch keine Commits.',
      'Clone' => 'Klonen',
      'Type' => 'Typ',
      'Callsign' => 'Kennung',
      'Update Frequency' => 'Update-Frequenz',
      'No description provided.' => 'Keine Beschreibung beigefügt.',
      'Update Now' => 'Jetzt aktualisieren',
      'Repository Active' => 'Repository aktiv',
      'Found Binary hg' => 'hg-Binary gefunden',
      'No Working Copy Yet' => 'Noch keine funktionierende Kopie',
      'Task Daemon Not Running' => 'Aufgaben-Dienst läuft nicht',
      'Edit Basic Information' => 'Grundlegende Informationen bearbeiten',
      'Deactivate Repository' => 'Repository deaktivieren',
      'Delete Repository' => 'Repository löschen',
      'Edit Policies' => 'Richtlinien bearbeiten',
      'New Repository' => 'Neues Repository',
      'No Commits' => 'Keine Commits',
      'All Repositories' => 'Alle Repositories',#a uppercase or lowercase?
      'Active Repositories' => 'Aktive Repositories',
      'Types' => 'Typen',
      'Most Recent Commit' => 'Neuestem Commit',
      'Creation (Newest First)' => 'Erstellungsdatum (Neuestes zuerst)',
      'Creation (Oldest First)' => 'Erstellungsdatum (Ältestes zuerst)',
      'Name Contains' => 'Name enthält',
     #Flags
      'Flag For Later' => 'Für später markieren',
      'Remove %s Flag' => 'Markierung %s entfernen',
      'Flag %s' => '%s markieren',
      'You can flag this %s if you want to remember to look at it later.' =>
       'Du kannst diesen %s makieren, um dir zu merken es später anzusehen.',
      'Create Flag' => 'Markierung erstellen',
      'Note' => 'Notiz',
      'Members' => 'Mitglieder',
      'Subprojects' => 'Subprojekte',
      'Manage' => 'Verwalten',
      'Project History' => 'Projekt Historie',
      'Looks Like' => 'Aussehen',
      
     #Feed
      #'Feed' => 'Neuigkeiten',
      'Notifications' => 'Meldungen',
      'Connected' => 'Verbunden',
      'Disconnected' => 'Nicht Verbunden',
      'You have no notifications.' => 'Du hast keine Meldungen.',
      'To begin on such a grand journey, requires but just a single step.' =>
       'Um diese große Reise zu beginnen, benötigt es nur einen kleinen Schritt.',
      'All Stories' => 'Alle Geschichten',
      'Notification Server not enabled.' => 'Meldungs-Server nicht eingeschaltet.',
      'Notification Server Issue' => 'Problem mit Meldungs-Server',
      'Unable to determine server status. This probably means the server '.
       'is not in great shape. The specific issue encountered was:' =>
       'Der Server Status kann nicht ermittelt werden. Das heißt wahrscheinlich, ' .
       'dass der Server keinen guten Zustand hat. Das genaue Problem ist:',
      'Notification Server Status' => 'Meldungs-Server Status',
      'Mark All Read' => 'Alle als gelesen makieren',
      'Really mark all notifications as read?' =>
       'Alle Meldungen als gelesen makieren?',
      "You can't ignore your problems forever, you know." =>
       'Du weißt, du kannst Probleme nicht für immer ignoriren',
      'Send Test Notification' => 'Test Meldung senden',
    
      'This is a test notification, sent at %s.' =>
       'Dies ist eine Test Meldung, gesendet am %s.',
      '%s created %s.' => '%s erstellte %s.',
      '%s edited %s.' => '%s bearbeitete %s.',
      '%s deleted %s.' => '%s entfernte %s.',
      '%s set %s to %s on %s.' => '%s setzte %s auf %s bei %s.',
      '%s changed %s from %s to %s on %s.' => '%s änderte %s von %s zu %s bei %s.',
     #Diffusion
      'Host and Browse Repositories' => 'Hoste und entdecke Repositories',
     #Audit
      'Browse and Audit Commits' => 'Entdecke und prüfe Commits',
     #Projects
      'Project' => 'Projekt',
      'Projects' => 'Projekte',
      'Get Organized' => 'Organisier dich',
      'Create Project' => 'Projekt erstellen',
      'Create New Project' => 'Neues Projekt erstellen',
      'Joined' => 'Beigetreten',
      'Active' => 'Aktiv',
      '%s created this project.' => '%s hat dieses Projekt erstellt.',
      "%s set this project's icon to %s." => '%s änderte das Projekt Symbol zu %s.',
      '%s renamed this project from "%s" to "%s".' => '%s benannte dieses Projekt von "%s" in "%s" um.',
      "%s set this project's color to %s." => '%s setzte die Projekt Farbe auf %s.',
      "%s changed the default filter for the project workboard." => '%s änderte den Standard Filter für das Projekt Workboard.',
      "Edit Details" => "Editiere Details",
      "Edit Menu" => "Editiere Menü",
      "Edit Picture" => "Editiere Bild",
      "Archive Project" => "Archiviere Projekt",
      "Milestones" => "Meilensteine",
      "Has Milestones" => "Hat Meilensteine",
      "None Created" => "Keine Erstellt",
      "You can create subprojects for this project." => "Du kannst ein Subprojekt für dieses Projekt erstellen.",
      "This project has milestones." => "Dieses Projekt hat Meilensteine.",
      "Subprojects and milestones are only partially implemented." => "Subprojekte und Meilensteine sind nur partiell implementiert",
      "Create Next Milestone" => "Erstelle den nächsten Meilenstein",
      "Create Subproject" => "Erstelle Subprojekt",
      "Create Milestone" => "Erstelle Meilenstein",
      "Milestone" => "Meilenstein",
      "Subprojects and Milestones" => "Subprojekte und Meilenstein",
      "This project does not have any members." => "Dieses Projekt hat keine Mitgleider.",
      "Watchers" => "Beobachter",
      "This project does not have any watchers." => "Dieses Projekt hat keine Beobachter.",
      "Membership" => "Mitgliedschaft",
      "Members and Watchers" => "Mitglieder und Beobachter",
      "Members of the parent project are members of this project." => "Mitglieder des Eltern Projekts sind Mitglieder dieses Projekts.",
      "Join Project" => "Projekt beitreten",
      "Leave Project" => "Projekt verlassen",
      "Watch Project" => "Projekt beobachten",
      "Disable Mail" => "Email deaktivieren",
      "Add Members" => "Mitglieder hinzufügen",
      "Lock Project" => "Projekt sperren",
      "Members of all subprojects are members of this project." => "Mitglieder von allen Subprojekten sind Mitglieder von diesem Projekt",
      "You can create milestones for this project." => "Du kannst Meilensteine für dieses Projekt erstellen",
      "Has Subprojects" => "Hat Subprojekte",
      "This project has subprojects." => "Dieses Projekt hat Subprojekte",
      "Warning" => "Warnung",
      'Parent Project' => 'Eltern Projekt',
      'Mail to Members' => 'Mail an Mitglieder',
      'You will receive mail that is sent to project members.' => 'Du wirst Emails erhalten die an Projekt Mitglieder gesandt werden.',
      '%s added a comment to %s.' => '%s kommentierte %s.',
      '%s edited the description of %s.' => '%s bearbeitete die Beschreibung von %s.',
      '%s edited the content of %s.' => '%s bearbeitete den Inhalt von %s.',
      '%s awarded %s a %s token.' => '%s verlieh %s das %s Zeichen.',
      '%s triaged %s as "%s" priority.' => '%s setzte die Priorität von %s auf "%s".',
      '%s changed the visibility for %s.' => '%s ändete die Sichtbarkeit von %s.',
      '%s changed the name of %s from %s to %s.' => '%s bennante %s von %s zu %s um.',
      '%s changed the start date of %s from %s to %s.' => '%s ändeterte die Startzeit von %s von %s zu %s.',
      '%s set the icon for %s to %s.' => '%s setzte das Symbol von %s auf %s.',
      '%s set the color for %s to %s.' => '%s setzte die Farbe von %s auf %s.',      
      '%s renamed %s from "%s" to "%s".' => '%s hat %s von "%s" in "%s" umbenannt.',
      '%s created this object with visibility "%s".' => '%s erstellte dieses Objekt mit Sichtbarkeits Richtlinie"%s".',
      '%s created this object with edit policy "%s".' => '%s erstellte dieses Objekt mit Bearbeitungs Richtlinie "%s".',
      '%s created this object with join policy "%s".' => '%s erstellte dieses Objekt mit Beitretungs Richtlinie "%s".',
      "%s updated this project's image from %s to %s." => "%s änderte das Projekt Bild von %s auf %s.",
      
      

     #Profiles
      'User Accounts and Profiles' => 'Benutzer und Profile',
      'Enabled' => 'Aktiviert',
      'User' => 'Benutzer',
      'User Account' => ' Benutzerkonto',
      'People' => 'Personen',
      'User Since' => 'Benutzer seit',
      'Roles' => 'Rollen',
      'Not Approved' => 'Nicht bestätigt',
      'Unverified' => 'Nicht Verifiziert',
      'Verified' => 'Verifiziert',
      'Available' => 'Verfügbar',
      'Edit Profile' => 'Profil bearbeiten',
      'Edit Profile Picture' => 'Profilbild bearbeiten',
      'Remove Administrator' => 'Adminitrator entfernen',
      'Change Username' => 'Benutzernamen ändern',
      'Disable User' => 'Benutzer deaktivieren',
      'Delete User' => 'Benutzer löschen',
      'Send Welcome Email' => 'Wilkommensmail senden',
      'Basic Policies' => 'Einfache Richtlinie',
      'All Users' => 'Alle Benutzer',
      'Administrators' => 'Administratoren',
      'No One' => 'Niemand',
      'User Policies' => 'Benutzer Richtlinie',
      'Advanced' => 'Fortgeschitten',
      'Custom Policy...' => 'Benutzerdefiniert Richtlinie...',
     #Conpherence' => '',
      'Conpherence Thread' => 'Conpherence Chat',
      'Chat with Others' => 'Diskutiere mit anderen',
      'Send Messages' => 'Sende Nachrichten',
      'Message' => 'Nachricht',
      'Messages' => 'Nachrichten',
      'You have no messages.' => 'Du hast keine Nachrichten',
      'To' => 'An',
      'Participants' => 'Teilnehmer',
      'Add Participants' => 'Teilnehmer hinzufügen',
      'Email me every update.' => 'Maile jede Aktualisierung.',
      'Notifications only.' => 'Nur Meldungen.',
      'Send Message' => 'Nachricht senden',
      'New Message' => 'Neue Nachricht',
      'Join a Room' => 'Einem Raum beitreten',
      'Create a Room' => 'Einen Raum erstellen',
      'No Messages' => 'Keine Nachrichten',
      'Messages: %d' => '%d Nachrichten',
      'Last updated %s' => 'Letzte Aktualisierung %s',
      '%s named this room "%s".' => '%s nannte den Chatroom "%s".',
      '%s changed the edit policy of this room from "%s" to "%s".' =>
       '%s änderte die Bearbeitungsrichtlinie dieses Chatrooms von "%s" zu "%s".',
      '%s changed the visibility of this room from "%s" to "%s".' =>
       '%s änderte die Sichtbarkeit dieses Chatrooms von "%s" zu "%s".',
     #Phriction
      'Last Author' => 'Letzter Autor',
      'Updated %s' => 'Aktualisiert %s',
      '%d Days Ago' => 'vor %d Tagen',
      'Table of Contents' => 'Inhaltsverzeichnis',
      'Document Hierarchy' => 'Dokumenten Hirarchie',
      'New Document' => 'Neues Dokument',
      'Edit Document' => 'Dokument bearbeiten',
      'Move Document' => 'Dokument verschieben',
      'View History' => 'Versionshistorie anzeigen',
      'Delete' => 'Löschen',
      'Delete Document' => 'Dokument löschen',
      'Delete Document?' => 'Dokument löschen',
      'Current Path' => 'Aktueller Pfad',
      'New Path' => 'Neuer Pfad',
      'Content' => 'Inhalt',
      'Edit Notes' => 'Notizen zur Veränderung',
      'To view a wiki document, you must also be able to view all of its parents.'=>
       'Um ein Wiki-Dokument anzusehen, musst du alle übergeordneten Dokumente sehen dürfen.',
      # incubus 2018 
      'Create a new document at' => 'Neues Dokument unter',
      'Edit this Document' => 'Bearbeite dieses Dokument',
      'The path to the document.' => 'Der Pfad zum Dokument',
      'No such document.' => 'Dokument nicht vorhanden',
      'Edit Older Version %s...' => 'Bearbeite ältere Version %s...',
      'DOCUMENT DIFF' => 'DOKUMENT DIFF',
      'This document was moved from $1.' => 'Dieses Dokument wurde von %s verschoben',
      'A moved document can not be moved again.' => 'Ein verschobenes Dokument kann nicht nochmal verschoben werden',
      'Last Edited' => 'Letzte Bearbeitung',
      'Publish Draft' => 'Veröffentliche Entwurf',
      'Moved' => 'Verschoben',
      'Other document activity not listed above occurs.' => 'Aktivität des vorher aufgeführten anderen Dokuments aufgetreten',
      'Version %s of %s: ' => 'Version %s von %s: ',
      'DOCUMENT CONTENT' => 'INHALT DES DOKUMENTS',
      'EDIT NOTES' => 'NOTIZEN BEARBEITEN',
      'Missing Ancestor' => 'Fehlender vorgänger',
      'This document has been moved to %s. You can edit it to put new content here, or use history to revert to an earlier version.' => 'Dieses Dokument wurde nach %s verschoben. Sie können es hier bearbeiten um neuen Inhalt hinzuzufügen, oder die History verwenden um zu einen früheren version zurück zu kehren.',
      'Retrieve information about a Phriction document.' => 'Hole Informationen über ein Phriction Dokument',
      "A document's subscribers change." => "Eine Abonenten wechsel des Dokuments",
      'Unknown document status \'%s\'!' => 'Unbekannter Dokumenten status \'%s\'',
      'Overwrite Changes' => 'Änderungen überschreiben',
      'Can Not Delete Document!' => 'Dokument kann nicht gelöscht werden!',
      'No parent/ancestor paths specified.' => 'Kein vorgänger Pfad spezifiziert.',
      'Unknown URI type \'%s\'!' => 'Unbekannter URI typ \'%s\'!',
      'Document path "%s" is not a valid path. The normalized form of this path is "%s".' => 'Dokumentpfad "%s" ist kein valider Pfad. Die normalisierte form diese Pfads ist "%s".',
      'There is no document here, but you may create it.' => 'Hier gibt es kein Dokument aber Sie können es erstellen.',
      'Edit Notes' => 'Bearbeite Notizen',
      'Phriction Wiki Document' => 'Phriction Wiki-Dokument',
      'Phriction Document' => 'Phriction Dokument',
      'You can not move this document there, because it would overwrite an existing document which is already at that location. Move or delete the existing document first.' => 'Sie können das Dokument nicht dort hin verschieben, weil es ein existierendes Dokument überschreiben würde welches sich bereits an dieser position befindet. Verschieben oder löschen Sie das existierende Dokument erst.',
      'To edit a wiki document, you must also be able to view all of its ancestors.' => 'Um ein Wiki-Dokument zu verändern, müssen Sie in der lage sein alle seine übergeordneten Dokumente zu sehen.',
      'Content Changes' => 'Inhalt verändert sich',
      'This version of the document is already the published version.' => 'Diese version des Dokuments ist schon die veröffentlichte Version',
      'Document Hierarchy' => 'Dokumenten Hierarchie',
      'This document was moved from elsewhere.' => 'Dieses Dokument wurde von woanders her verschoben.',
      'More...' => 'Mehr...',
      "A document's title changes." => "Der Dokumenten Titel ändert sich",
      'Save and Publish' => 'Speichern und Veröffentlichen',
      'Current Path' => 'Aktueller Pfad',
      '(Untitled Document)' => '(Unbenanntes Dokument)',
      'Phriction User Guide' => 'Phriction Benutzerhandbuch',
      '%s moved this document to %s.' => '%s verschob dieses Dokument nach %s.',
      'Content' => 'Inhalt',
      'Update a Phriction document.' => 'Überarbeite ein Phriction Dokument',
      'Revert the published version of this document to an older version?' => 'Dokument wieder auf eine ältere Version zurück setzen?',
      'Document Content' => 'Inhalt des Dokuments',
      'Another user made changes to this document after you began editing it. Do you want to overwrite their changes? (If you choose to overwrite their changes, you should review the document edit history to see what you overwrote, and then make another edit to merge the changes if necessary.)' => 'Ein anderer Benutzer hat änderungen an diesem Dokuemnt vorgenommen nachdem Sie angefangen haben es zu verändern. Möchten Sie die änderungen überschreiben? (Wenn Sie sich entscheiden die Änderungen zu überschreiben, sollten Sie die History des Dokuments einsehen und nachverfolgen was Sie überschrieben haben und das Dokument um diese änderungen wenn nötig ergänzen.)',
      'Can not create document because the parent document with slug %s does not exist!' => 'Kann das Dokument nicht erstellen weil das übergeordnete Dokument mit slug %s nicht existiert.',
      'Edit Phriction Document Configurations' => 'Bearbeite die Phriction-Dokument Einstellungen',
      'Accept Path' => 'Akzeptiere Pfad',
      'Content object "%s" can not be published because it belongs to a different document.' => 'Inhalts Objekt "%s" kann nicht bearbeitet werden, da es zu einem anderen Dokument gehört',
      'Edit Current Version %s...' => 'Bearbeite aktuelle Version %s...',
      'Edit this Document' => 'Bearbeite dieses Dokument',
      'Document History: $1' => 'Dokumenten History: %s',
      'Ancestor Paths' => 'Übergeordnete Vorgänger Pfade',
      'To view a wiki document, you must also be able to view all of its ancestors. The most-restrictive view policy of this document\'s ancestors is "%s".' => 'Um ein Wiki-Dokument anzuzeigen, müssen Sie in der Lage sein alle übergeordneten Vorgänger anzuzeigen. Die restriktivste Anzeigepolitik der übergeordneten Vorgänger ist "%s".',
      'Wiki Documents' => 'Wiki Dokumente',
      'This document has been moved. You can edit it to put new content here, or use history to revert to an earlier version.' => 'Dieses Dokument wurde verschoben. Sie können es hier bearbeiten um neuen Inhalt hinzuzufügen, oder die History verwenden um zu einen früheren version zurück zu kehren.',
      'Edit Draft Version %s...' => 'Bearbeite Entwurfsversion %s...',
      'Document this content is for.' => 'Das Dokument für welches dieser Inhalt ist.',
      'You are viewing an unpublished draft of this document.' => 'Sie sehen eine unveröffentlichte Version dieses Dokuments.',
      '%s deleted this document.' => '%s hat dieses Dokument gelöscht',
      'An already deleted document can not be deleted.' => 'Ein bereits gelöschtes Dokument kann nicht noch mal gelöscht werden',
      '%s published a new version of %s.' => '%s hat eine neue Version von %s veröffentlicht.',
      'No such document exists.' => 'Solch ein Dokument existiert nicht.',
      'Edit Existing Document?' => 'Bereits existierendes Dokument bearbeiten?',
      'Read information about Phriction documents.' => 'Informationen über Phriction-Dokumente lesen.',
      'The document %s already exists. Do you want to edit it instead?' => 'Das Dokument %s existiert bereits. Wollen Sie es bearbeiten?',
      'A deleted document can not be moved.' => 'Ein bereits gelöschtes Dokument kann nicht verschoben werden.',
      'Printable Page' => 'Druckbare Seite',
      'Welcome to Phriction' => 'Wilkommen zu Phriction',
      'Options related to Phriction (wiki).' => 'Optionen für Phriction (wiki).',
      'CHANGES TO DOCUMENT CONTENT' => 'ÄNDERUNGEN AM DOKUMENTENINHALT',
      '%s moved %s from %s' => '%s verschob %s von %s',
      'This document is empty. You can edit it to put some proper content here.' => 'Dieses Dokument ist leer. Sie können es bearbeiten um inhalt hinzuzufügen.',
      'Publish Draft?' => 'Entwurf Veröffentlichen?',
      'A document is deleted.' => 'Ein Dokument wurde gelöscht',
      'Would you like to use the path %s instead?' => 'Würden Sie gern den Pfad %s anstelle verwenden?',
      'Delete Document?' => 'Dokument löschen?',
      'Document Deleted' => 'Dokument gelöscht',
      'Content version.' => 'Inhaltsversion.',
      'Documents must have content.' => 'Das Dokument muss einen Inhalt haben.',
      'You can not move a document to its existing location. Choose a different location to move the document to.' => 'Sie können ein Dokument nicht an seine aktuelle Position verschieben. Wählen Sie eine andere Position.',
      'Document History' => 'Dokumenten History',
      'Draft %s' => 'Entwurf %s',
      'Original Change' => 'Änderung des Originals',
      'Document already exists!' => 'Dokument existiert bereits!',
      '%s moved %s to %s.' => '%s verschob %s nach %s',
      'Phriction is a simple and easy to use wiki for keeping track of documents and their changes.' => 'Phriction ist ein einfach zu benutzendes Wiki, welches es erlaubt Dokumente und deren Änderungen zu verfolgen.',
      'Subject prefix for Phriction email.' => 'Betreffprefix für die Phriction email.',
      'The path you entered (%s) is not a valid wiki document path. Paths may not contain spaces or special characters.' => 'Der Pfad den Sie eingegeben haben (%s) ist nicht zulässig. Pfade dürfen keine Leerzeichen oder Sonderzeichen beeinhalten.',
      'View Draft Version' => 'Entwurfsversion anzeigen',
      'Edit Conflict' => 'Konflikt bearbeiten',
      '%s edited the content of %s.' => '%s hat den Inhalt von %s bearbeitet.',
      'This document has unpublished draft changes.' => 'Dieses Dokument hat unveröffentlichte Entwurfsänderungen',
      '%s edited the content of this document.' => '%s hat den Inhalt dieses Dokuments bearbeitet.',
      'This document is already deleted. You must specify content to re-create the document and make further edits.' => 'Dieses Dokument wurde bereits gelöscht. Sie müssen neuen Inhalt hinzufügen um das Dokument wieder neu zu erstellen und weitere Änderungen vornehmen zu können.',
      'Parent Paths' => 'Vorgänger Pfade',
      '%s published a new version of this document.' => '%s hat eine neue Version dieses Dokuments veröffentlicht.',
      'You are viewing the current published version of this document.' => 'Sie sehen die aktuelle veröffentlichte Version dieses Dokuments.',
      'Update the published version of this document to this newer version?' => 'Die veröffentlichte Version dieses Dokuments auf eine neuere updaten?',
      '%s changed the title from %s to %s.' => '%s hat den titel von %s auf %s geändert.',
      'Publish Older Version?' => 'Eine ältere Version veröffentlichen?',
      '%s moved this document from %s' => '%s hat dieses Dokument von %s verschoben',
      'Hierarchy' => 'Hierarchie',
      'Save as Draft' => 'Als Entwurf speichern',
      'Edited by %s' => 'Geändert von %s',
      'No Document Here' => 'Kein Dokument an diesem Ort',
      "A document's content changes." => "Der Inhalt eines Dokuments hat sich verändert.",
      'A moved document can not be deleted.' => 'Ein verschobenes Dokument kann nicht gelöscht werden.',
      'Adjust Path' => 'Pfad anpassen',
      'Read information about Phriction document history.' => 'Information über die Phriction Dokument History lesen.',
      'Test rules which run when a wiki document is created or updated.' => 'Regeln testen welche ausgeführt werden wenn Wiki-Dokumente erzeugt oder geändert werden.',
      'Can not move document because the parent document with slug %s does not exist!' => 'Das Dokument kann nicht gelöscht werden weil das übergeordnete Dokument mit slug %s nicht existiert!',
      '%s by %s, %s' => '%s von %s, %s',
      'Publish Older Version' => 'Veröffentliche ältere Version',
      'Create this Document' => 'Erzeuge dieses Dokument',
      'This engine is used to edit Phriction documents.' => 'Dieses System wird verwendet um Phriction Dokumente zu bearbeiten.',
      'Edits' => 'Bearbeitungen',
      'Already Published' => 'Schon Veröffentlicht',
      'Retrieve history about a Phriction document.' => 'Hole die History eines Phriction-Doukemnts',
      'Create a Phriction document.' => 'Erzeuge ein Phriction-Dokument.',
      'You are viewing an older version of this document, as it appeared on %s.' => 'Sie sehen eine ältere Version dieses Dokuments, so wie sie in %s aufgetaucht ist.',
      'Status information about the document.' => 'Status Informationen über das Dokument.',
      'React to wiki documents being created or updated.' => 'Reagiere auf Wiki-Dokumente die erstellt oder verändert werden.',
      'Document Fields' => 'Dokument Felder',
      'All Content' => 'Gesammter Inhalt',
      'Phriction Content' => 'Phriction Inhalt',
      'Phriction Document Content' => 'Phriction Dokumenteninhalt',
      'Created through child' => 'Durch ein untergeordnetes Dokument erstellt',
      'Page Not Found' => 'Seite nicht gefunden',
      'New Document' => 'Neues Dokument',
      'Empty Document' => 'Leeres Dokument',
      'Move Here' => 'Hierher verschieben',
      'Get the content of documents or document histories.' => 'Hole den Inhalt von Dokumenten oder deren History',
      'Create a new document at' => 'Erzeuge ein Dokument unter',
      'New Path' => 'Neuer Pfad',
      'Phriction Documents' => 'Phriction Dokumente',
      'You can not create a document which does not have a parent.' => 'Sie können kein Dokument erstellen welches keinen übergeordneten Vorgänger hat',
      'Most Recent Change' => 'Neuste Änderung',
      'Really delete this document? You can recover it later by reverting to a previous version.' => 'Wollen Sie dieses Dokument wirklich löschen? Sie können es wiederherstellen in dem Sie es auf eine früheren Version zurücksetzen.',
      'This document has been deleted. You can edit it to put new content here, or use history to revert to an earlier version.' => 'Dieses Dokument wurde gelöscht. Sie können es bearbeiten um neunen Inhalt hinzuzufügen oder die History verwenden um zu eine früheren Version zurückzukehren.',
      'Wiki Document %s' => 'Wiki-Dokument %s',
      'Move Away' => 'Geh Weg',

     #Calendar
      'Event' => 'Termin',
      'Calendar Event' => 'Kalender Termin',
      'Calendar' => 'Kalender',
      'From %s to %s' => 'Von %s bis %s',
      'Create Event' => 'Termin erstellen',
      'Create Private Event' => 'Privaten Termin erstellen',
      'Create Public Event' => 'Öffentlichen Termin erstellen',
      'Choose Icon...' => 'Symbol auswählen...',
      'Choose Calendar Event Icon' => 'Termin Symbol wählen',
      'Edit Event' => 'Termin bearbeiten',
      'Join Event' => 'Teilnehmen',
      'Decline' => 'Ablehnen',
      'Accept' => 'Akzeptieren',
      'Would you like to join this event?' =>
       'Möchtest du an diesem Termin teilnehmen?',
      'Decline Event' => 'Teilnahme absagen',
      'Cancel Event' => 'Termin absagen',
      'You can always reinstate the event later.' =>
       'Du kannst den Termin später wiederherstellen.',
      "Don't Cancel Event" => 'Termin nicht absagen',
      'Reinstate Event' => 'Termin wiederherstellen',
      'Reinstate this event?' => 'Diesen Termin wiederherstellen?',
      "Don't Reinstate Event" => 'Termin abgesagt belassen',
      'Clear sailing ahead.' => 'Freie Fahrt voraus.',
      'No events found.' => 'Keine Termine gefunden.',
      'My Events' => 'Meine Termine',
      'End' => 'Ende',
      'Starts' => 'Beginnt',
      'Ends' => 'Endet',
      'Invitees' => 'Teilnehmer',
      'All Day Event' => 'Ganztägiger Termin',
      'Month View' => 'Monats Ansicht',
      'Day View' => 'Tages Ansicht',
      'Upcoming Events' => 'Kommende Termine',
      'All Events' => 'Alle Termine',
      'Created By' => 'Erstellt von',
      'Invited' => 'Teilnehmer',
      'Occurs After' => 'Nach',
      'Occurs Before' => 'Vor',
      'Show only upcoming events.' => 'Zeige nur kommende Termine',
      'Cancelled Events' => 'Abgesagte Termine',
      'Display Options' => 'Anzeige Optionen',
      'Add To Plate' => 'An die Tafel schreiben...',
      '%s created this event.' => '%s erstellete diesen Termin.',
      '%s edited this %s.' => '%s bearbeitete diesen %s.',
      '%s changed the name of this event from %s to %s.' =>
       '%s bennante diesen Termin von %s zu %s um.',
      '%s made this an all day event.' => '%s machte dies zu einem Ganztagstermin.',
      '%s converted this from an all day event.' => '%s deaktivierte den Ganztagstermin status.',
      "%s updated the event's description." =>' %s aktualisierte die Terminbeschreibung',
      '%s invited %s.' => '%s lud %s ein.',
      '%s has joined this event.' => '%s ist dem Termin beigetreten.',
      '%s is attending this event.' => '%s nimmt teil.',
      '%s is attending %s.' => '%s nimmt an %s teil.',
      'Would you like to decline this event?' =>
       'Möchtest du wirklich nicht teilnehmen?',
      '%s has declined this event.' => '%s kann nicht teilnehmen.',
      '%s has declined %s.' => '%s kann nicht an %s teilnehmen.',
      '%s cancelled this event.' => '%s sagte den Termin ab.',
      '%s cancelled %s.' => '%s sagte %s ab.',
      '%s reinstated this event.' => '%s hat den Termin wiederhergestellt',
      '%s reinstated %s.' => '%s hat %s wiederhergestellt',
      '%s edited the end date of this event.' => '%s änderte die Endzeit des Termins.',
      '%s edited the start date of this event.' => '%s änderte die Startzeit des Termins.',
      "%s set this event's icon to %s." => '%s setzte das Terminsymbol auf %s',
      '%s invited %s to %s.' => '%s lud %s zu %s ein.',
      '%s made %s an all day event.' => '%s machte %s zu einem Ganztagstermin.',
      '%s converted %s from an all day event.' => '%s deaktivierte den Ganztagstermin status von %s',
    
     #Files' => '',
      'Files' => 'Dateien',
      'Store and Share Files' => 'Speichere und teile Dateien',
      'Drop Files to Upload' => 'Lege Dateien zum Hochladen ab',
      'Image' => 'Bild',
      'Countdown to Events' => 'Countdown zu Events',
     #Settings
      'Settings' => 'Einstellungen',
      'Edit Settings' => 'Einstellungen bearbeiten',
      'Save Preferences' => 'Einstellungen speichern',
      'Save Account Settings' => 'Einstellungen speichern',
      'Account Settings' => "Profil Einstellungen",
      'Account' => 'Profil',
      'Translation' => 'Übersetzung',
      'Pronoun' => 'Ansprache',
      '%s updated their profile' => '%s haben ihr Profil aktualisiert',
      '%s updated his profile' => '%s hat sein Profil aktualisiert',
      '%s updated her profile' => '%s hat ihr Profil aktualisiert',
      '**Choose the pronoun you prefer:**' => "(WARNING)Version 2.3.1 " .
       "zu Phabricator Version [76665f725bc9](https://secure.phabricator.com/rP76665f725bc90c5122b4f9f5cf80b75fedbdf885)" .
       "\n\n___\n\n**Wähle deine bevorzugte Ansprache:**",
      'Date and Time Settings' => 'Datum und Zeiteinstellungen',
      'Timezone' => 'Zeitzone',
      'Time-of-Day Format' => 'Uhrzeit Format',
      'Format used when rendering a time of day.' => 'Format, das benutzt wird, um die Tageszeit darzustellen.',
      'Date Format' => 'Datum Format',
      'Format used when rendering a date.' => 'Format, das benutzt wird, um ein Datum darzustellen.',
      'European (28-02-2000)' => 'Europäisch (28-02-2000)',
      'Week Starts On' => 'Woche startet am',
      'Calendar weeks will start with this day.' => 'Kalender Wochen beginnen mit diesem Tag.',
      '12-hour (2:34 PM)' => '12 Stunden (2:34 PM)',
      '24-hour (14:34)' => '24 Stunden (14:34)',
      #Config
      'Configure Phabricator' => 'Konfiguriere Phabricator',
            
     #404
      'Do not dwell in the past, do not dream of the future, '.
        'concentrate the mind on the present moment.' => 'Verbleibe '.
        'nicht in der Vergangenheit, träume nicht von der Zukunft, '.
        'Konzentriere dich auf den gegenwärtigen Moment.',
      'Focus' => 'Konzentrieren',
     #Auth' => '',
      'Login to Phabricator' => 'Anmelden bei Phabricator',
      'Username or Email' => 'Benutzername oder Email',
      'Password' => 'Passwort',
      'Forgot your password?' => 'Passwort vergessen?',
      'Register New Account' => 'Neuen Account erstellen',
      'Phabricator Username' => 'Phabricator Benutzername',
      'Real Name' => 'Echter Name',
      'Confirm Password' => 'Passwort bestätigen',
      'Minimum length of %d characters.' => 'Minimale Länge von %d Buchstaben.',
      'Register Phabricator Account' => 'Registriere Phabricator Account',
      'Login' => 'Anmelden',
      'Log out of Phabricator?' => 'Ausloggen',
      'Are you sure you want to log out?' => 'Bist du sicher, dass du dich abmelden willst?',
      'Log Out' => 'Ausloggen',
      'Logout' => 'Abmelden',
     #Date/Time
      'Date' => 'Datum',
      'Time' => 'Zeit',
      'Date and Time' => 'Datum und Uhrzeit',
     #Days
      'MTWTFSS' => 'MDMDFSS',
      'Mon' => 'Mo',
      'Tue' => 'Di',
      'Wed' => 'Mi',
      'Thu' => 'Do',
      'Fri' => 'Fr',
      'Sat' => 'Sa',
      'Sun' => 'So',
      'Monday' => 'Montag',
      'Tuesday' => 'Dienstag',
      'Wednesday' => 'Mittwoch',
      'Thursday' => 'Donnerstag',
      'Friday' => 'Freitag',
      'Saturday' => 'Samstag',
      'Sunday' => 'Sonntag',
      'Yesterday' => 'Gestern',
      'Today' => 'Heute',
      'Tomorrow' => 'Morgen',
     #Months
      'Mar' => 'Mär',
      'May' => 'Mai',
      'Oct' => 'Okt',
      'Dec' => 'Dez',
      'January' => 'Januar',
      'February' => 'Februar',
      'March' => 'März',
      'April' => 'April',
      'June' => 'Juni',
      'July' => 'Juli',
      'October' => 'Oktober',
      'November' => 'November',
      'December' => 'Dezember'
    );
  }
}
